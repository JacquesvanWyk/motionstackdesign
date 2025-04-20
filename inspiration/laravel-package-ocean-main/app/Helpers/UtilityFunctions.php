<?php

use Carbon\Carbon;
use Composer\Semver\Constraint\ConstraintInterface;
use Composer\Semver\Constraint\MultiConstraint;
use Composer\Semver\Intervals;
use Composer\Semver\Semver;
use Composer\Semver\VersionParser;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

function isValidVersionConstraint($constraintString): bool
{
    $versionParser = new VersionParser;

    try {
        $constraint = $versionParser->parseConstraints($constraintString);
        Intervals::get($constraint);

        return true;
    } catch (\Exception $e) {
        return false;
    }
}

function fetchActiveLaravelVersions()
{
    return cache()->remember('active_laravel_versions', now()->addDay(), function () {
        try {
            $response = Http::retry(3, 100, function ($exception) {
                return $exception instanceof ConnectionException;
            })
                ->get('https://laravelversions.com/api/versions');

            if ($response->successful()) {
                return extractActiveVersionsFromLaravelVersions($response);
            } else {
                // If the primary source fails, try the fallback source
                return fetchVersionsFromEndOfLife();
            }
        } catch (\Exception $e) {
            // If there's an exception, try the fallback source
            Log::error('Error fetching active Laravel versions: '.$e->getMessage());

            return fetchVersionsFromEndOfLife();
        }
    });
}

function extractActiveVersionsFromLaravelVersions($response)
{
    $data = $response->json('data');
    $activeVersions = collect($data)
        ->where('status', 'active')
        ->pluck('latest')
        ->sort()
        ->values()
        ->toArray();

    return empty($activeVersions) ? ['11.0.0'] : $activeVersions;
}

function fetchVersionsFromEndOfLife()
{
    $response = Http::get('https://endoflife.date/api/laravel.json');

    if ($response->successful()) {
        $data = $response->json();
        $today = now();

        $activeVersions = collect($data)
            ->filter(function ($version) use ($today) {
                // Check if the support date is still valid
                return $today->lessThan($version['support']);
            })
            ->pluck('latest')
            ->sort()
            ->values()
            ->toArray();

        return empty($activeVersions) ? ['11.0.0'] : $activeVersions;
    }

    return ['11.0.0']; // Default fallback if both sources fail
}

function latestActiveLaravelVersion()
{
    return collect(fetchActiveLaravelVersions())->last();
}

function isCompatibleWithLaravelActiveVersions($dependencies): bool
{
    $activeVersions = fetchActiveLaravelVersions();

    foreach ($dependencies as $versionConstraint) {
        // Preprocess the version constraint
        $preprocessedConstraint = preprocessVersionConstraint($versionConstraint);

        foreach ($activeVersions as $activeVersion) {
            if (Semver::satisfies($activeVersion, $preprocessedConstraint)) {
                return true; // Found a compatible version
            }
        }
    }

    return false; // No compatible versions found
}

function preprocessVersionConstraint($constraint)
{
    // Handle range constraints like '5.0 - 5.8' and convert them into '>=5.0 <5.9'
    $constraint = preg_replace_callback('/(\d+\.\d+) - (\d+\.\d+)/', function ($matches) {
        // Increment the minor version of the upper bound
        $upperBound = explode('.', $matches[2]);
        $upperBound[1] = strval(intval($upperBound[1]) + 1);

        return '>= '.$matches[1].' < '.implode('.', $upperBound);
    }, $constraint);

    // Handle wildcard constraints like ^10.*
    $constraint = str_replace('.*', '', $constraint);

    // Split the constraint on '||', add comparator if missing, then join back
    return implode(' || ', array_map(function ($part) {
        $part = trim($part);
        if (! preg_match('/^[><=~^]/', $part)) {
            return '^'.$part; // Add '^' if no comparator is present
        }

        return $part;
    }, explode('||', $constraint)));
}

function isVersionSatisfiedByConstraint($version, ConstraintInterface $constraint)
{
    if ($constraint instanceof MultiConstraint) {
        // For MultiConstraint, check if any sub-constraint is satisfied
        foreach ($constraint->getConstraints() as $subConstraint) {
            if (isVersionSatisfiedByConstraint($version, $subConstraint)) {
                return true;
            }
        }

        return false;
    } else {
        // For a regular Constraint, directly check for satisfaction
        return Semver::satisfies($version, $constraint);
    }
}

function formatSemverVersion($version)
{
    // Remove any pre-release suffixes
    $version = preg_replace('/\-dev|\-alpha|\-beta|\-RC/', '', $version);

    // Keep only the first three parts of the version
    $parts = explode('.', $version);
    if (count($parts) > 3) {
        $version = implode('.', array_slice($parts, 0, 3));
    }

    return $version;
}

function isGithubRepositoryHealthy($repository): bool
{
    $response = Http::timeout(60)->connectTimeout(60)->withHeaders([
        'Authorization' => 'Bearer '.config('services.github.token'),
    ])->get('https://api.github.com/repos/'.$repository);

    if ($response->failed()) {
        return false;
    }

    $data = $response->json();

    if ($data['archived']) {
        return false;
    }

    if ($data['disabled']) {
        return false;
    }

    if ($data['private']) {
        return false;
    }

    if (data_get($data, 'message') === 'Not Found') {
        return false;
    }

    if (now()->subYear()->greaterThan($data['pushed_at'])) {
        return false;
    }

    return true;
}

function reportGithubRepositoryHealthStatus($repository): string|bool
{
    $response = Http::timeout(60)->connectTimeout(60)->withHeaders([
        'Authorization' => 'Bearer '.config('services.github.token'),
    ])->get('https://api.github.com/repos/'.$repository);

    if ($response->failed()) {
        return 'The repository could not be accessed.';
    }

    $data = $response->json();

    if ($data['archived']) {
        return 'The repository is archived.';
    }

    if ($data['disabled']) {
        return 'The repository is disabled.';
    }

    if ($data['private']) {
        return 'The repository is private.';
    }

    if (data_get($data, 'message') === 'Not Found') {
        return 'The repository was not found.';
    }

    if (now()->subYear()->greaterThan($data['pushed_at'])) {
        return 'The repository has not been updated in the last year.';
    }

    return true;
}

// Get author and name of repo from the github link
// Example: https://github.com/spatie/once -> spatie/once
function extractRepoFromGithubUrl($url): ?string
{
    // Use regular expression to match the GitHub URL pattern
    $pattern = '/https?:\/\/github\.com\/([^\/]+)\/([^\/]+)/i';

    // Execute the regular expression match
    if (preg_match($pattern, $url, $matches)) {
        // If a match is found, return the author and repo name in the desired format
        return $matches[1].'/'.$matches[2];
    }

    // Return null if no match is found
    return null;
}

function fetchGithubStars($url): int
{
    $githubData = Http::retry(3, 100, function ($exception) {
        return $exception instanceof ConnectionException;
    })
        ->timeout(60)
        ->connectTimeout(60)
        ->withHeaders([
            'Authorization' => 'Bearer '.config('services.github.token'),
        ])
        ->get('https://api.github.com/repos/'.extractRepoFromGithubUrl($url));

    if ($githubData->failed()) {
        return 0;
    }

    return $githubData->json('stargazers_count');
}

function getNpmData($npm): array
{
    $npmData = Http::retry(3, 100, function ($exception) {
        return $exception instanceof ConnectionException;
    })
        ->timeout(60)
        ->connectTimeout(60)
        ->get('https://registry.npmjs.org/'.$npm);

    if ($npmData->failed()) {
        return [];
    }

    $first_release_at = $npmData->json('time.created');
    $latest_release_at = $npmData->json('time.modified');

    return [
        'first_release_at' => $first_release_at ? Carbon::parse($first_release_at)->format('Y-m-d H:i:s') : null,
        'latest_release_at' => $latest_release_at ? Carbon::parse($latest_release_at)->format('Y-m-d H:i:s') : null,
    ];
}

function getPackagistData($composer): array
{
    $packagistData = Http::retry(3, 100, function ($exception) {
        return $exception instanceof ConnectionException;
    })
        ->timeout(60)
        ->connectTimeout(60)
        ->get('https://packagist.org/packages/'.$composer.'.json');

    $minimalPackagistData = Http::retry(3, 100, function ($exception) {
        return $exception instanceof ConnectionException;
    })
        ->timeout(60)
        ->connectTimeout(60)
        ->get('https://repo.packagist.org/p2/'.$composer.'.json');

    if ($packagistData->failed() || $minimalPackagistData->failed()) {
        return [];
    }

    $first_release_at = $packagistData->json('package.time');
    $latest_release_at = extractLatestReleaseFromPackagistData($minimalPackagistData->json());
    $laravel_dependency_versions = extractLaravelDependencyVersions($minimalPackagistData->json());

    return [
        'first_release_at' => $first_release_at ? Carbon::parse($first_release_at)->format('Y-m-d H:i:s') : null,
        'latest_release_at' => $latest_release_at ? Carbon::parse($latest_release_at)->format('Y-m-d H:i:s') : null,
        'laravel_dependency_versions' => $laravel_dependency_versions,
    ];
}

function extractLatestReleaseFromPackagistData($minimalPackagistData): ?string
{
    if (! isset($minimalPackagistData['packages']) || empty($minimalPackagistData['packages'])) {
        return null;
    }

    $packages = array_values($minimalPackagistData['packages'])[0];
    foreach ($packages as $release) {
        if (strpos($release['version'], 'dev') === false &&
            strpos($release['version'], 'alpha') === false &&
            strpos($release['version'], 'beta') === false &&
            strpos($release['version'], 'rc') === false) {
            return $release['time'];
        }
    }

    return null;
}

function extractLaravelDependencyVersions($minimalPackagistData): array
{
    $latestRelease = extractLatestReleaseForDependencies($minimalPackagistData);
    if (! $latestRelease) {
        return [];
    }

    $supportedVersions = [];
    $dependencies = array_merge(
        $latestRelease['require'] ?? [],
        $latestRelease['require-dev'] ?? []
    );

    foreach ($dependencies as $dependency => $version) {
        if ((strpos($dependency, 'illuminate/') === 0 || $dependency === 'laravel/framework') &&
            $version !== '*' && isValidVersionConstraint($version)) {
            $supportedVersions[] = $version;
        }
    }

    return array_values(array_unique($supportedVersions));
}

function extractLatestReleaseForDependencies($minimalPackagistData): ?array
{
    if (! isset($minimalPackagistData['packages']) || empty($minimalPackagistData['packages'])) {
        return null;
    }

    $packages = array_values($minimalPackagistData['packages'])[0];
    foreach ($packages as $release) {
        if (strpos($release['version'], 'dev') === false &&
            strpos($release['version'], 'alpha') === false &&
            strpos($release['version'], 'beta') === false &&
            strpos($release['version'], 'rc') === false) {
            return $release;
        }
    }

    return null;
}
