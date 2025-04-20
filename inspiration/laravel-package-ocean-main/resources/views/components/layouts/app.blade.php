<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{
        darkMode: $persist(
            window.matchMedia('(prefers-color-scheme: dark)').matches,
        ),
    }"
    x-bind:class="{ 'dark': darkMode === true }"
>
    <head>
        <meta
            http-equiv="Content-Security-Policy"
            content="upgrade-insecure-requests"
        />
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1"
        />

        <title>
            {{ $title ?? 'Laravel Package Ocean - Discover new & useful Laravel packages' }}
        </title>

        <meta
            name="description"
            content="A place where you can find any Laravel package that you may need for your next project."
        />

        {{-- SEO --}}
        {!! seo($SEOData ?? null) !!}

        {{-- RSS --}}
        @include('feed::links')

        {{-- Favicon --}}
        <meta
            name="msapplication-TileColor"
            content="#2b5797"
        />
        <meta
            name="theme-color"
            content="#04041F"
        />
        <link
            rel="apple-touch-icon"
            sizes="180x180"
            href="/favicon/apple-touch-icon.png?v=tepFhZKP8"
        />
        <link
            rel="icon"
            type="image/png"
            sizes="32x32"
            href="/favicon/favicon-32x32.png?v=tepFhZKP8"
        />
        <link
            rel="icon"
            type="image/png"
            sizes="16x16"
            href="/favicon/favicon-16x16.png?v=tepFhZKP8"
        />
        <link
            rel="manifest"
            href="/favicon/site.webmanifest?v=tepFhZKP8"
        />
        <link
            rel="mask-icon"
            href="/favicon/safari-pinned-tab.svg?v=tepFhZKP8"
            color="#5bbad5"
        />
        <link
            rel="shortcut icon"
            href="/favicon/favicon.ico?v=tepFhZKP8"
        />

        {{-- Alpine Style --}}
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        <script>
            // Function to check and correct date format in localStorage
            function checkAndCorrectDateFormat(key) {
                let value = localStorage.getItem(key)

                // Check if the value exists and is not in double quotes
                if (value && !value.startsWith('"')) {
                    // Correct the format by adding double quotes
                    value = '"' + value + '"'
                    localStorage.setItem(key, value)
                }

                // Now check if the value is a valid ISO date
                if (value) {
                    // Remove the double quotes for validation
                    value = value.replace(/"/g, '')

                    // Check if the date is valid
                    if (isNaN(Date.parse(value))) {
                        // If not a valid date, remove the item from localStorage
                        localStorage.removeItem(key)
                    }
                }
            }

            // Check and correct the date formats
            checkAndCorrectDateFormat('lastVisitDate')
            checkAndCorrectDateFormat('newVisitDate')
        </script>

        {{-- Livewire --}}
        @livewireStyles

        {{-- Vite --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- Google Analytics --}}
        <script
            async
            src="https://www.googletagmanager.com/gtag/js?id=G-S0ENKYYZTV"
        ></script>
        <script>
            window.dataLayer = window.dataLayer || []
            function gtag() {
                dataLayer.push(arguments)
            }
            gtag('js', new Date())

            gtag('config', 'G-S0ENKYYZTV')
        </script>
    </head>
    <body
        x-cloak
        class="bg-[#FAFCFF] selection:bg-stone-800/10 dark:bg-[#04041F] dark:text-[#EAEFFB] dark:selection:bg-indigo-100/10"
    >
        {{ $slot }}

        @livewireScriptConfig
    </body>
</html>
