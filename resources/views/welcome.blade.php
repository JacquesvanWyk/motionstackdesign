<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<style>
    :root {
        --bg-primary: #ffffff;
        --bg-secondary: #f8fafc;
        --text-primary: #0f172a;
        --text-secondary: #64748b;
        --accent-primary: #9333ea;
        --accent-secondary: #3b82f6;
        --border-color: rgba(0, 0, 0, 0.1);
        --card-bg: rgba(255, 255, 255, 0.05);
        --card-hover: rgba(255, 255, 255, 0.1);
        --gradient-overlay: rgba(255, 255, 255, 0.2);
    }

    .dark {
        --bg-primary: #04041F;
        --bg-secondary: #0a0a29;
        --text-primary: #ffffff;
        --text-secondary: #a1a1aa;
        --accent-primary: #9333ea;
        --accent-secondary: #3b82f6;
        --border-color: rgba(255, 255, 255, 0.1);
        --card-bg: rgba(255, 255, 255, 0.05);
        --card-hover: rgba(255, 255, 255, 0.1);
        --gradient-overlay: rgba(59, 130, 246, 0.2);
    }

    /* Theme transition */
    *, *::before, *::after {
        transition-property: background-color, border-color, color, fill, stroke;
        transition-duration: 500ms;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Animated border like NativePHP */
    .animated-border {
        position: relative;
        border-radius: 0.75rem;
        overflow: hidden;
    }
    
    .animated-border::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: 0.75rem;
        padding: 2px; /* Border width */
        background: linear-gradient(90deg, #3b82f6, #9333ea, #3b82f6);
        background-size: 200% 200%;
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 1;
    }
    
    .animated-border-purple::before {
        background: linear-gradient(90deg, #9333ea, #3b82f6, #9333ea);
        background-size: 200% 200%;
    }
    
    .group:hover .animated-border::before {
        opacity: 1;
        animation: border-rotate 3s linear infinite;
    }
    
    @keyframes border-rotate {
        0% {
            background-position: 0% 0%;
        }
        50% {
            background-position: 100% 100%;
        }
        100% {
            background-position: 0% 0%;
        }
    }
    
    /* Animated border line that runs around the element */
    .border-line {
        position: absolute;
        z-index: 1;
        overflow: hidden;
        border-radius: 0.75rem;
    }
    
    .border-line::before {
        content: '';
        position: absolute;
        width: 300%;
        height: 1px;
        background: linear-gradient(90deg, transparent, #3b82f6, #9333ea, transparent);
    }
    
    .border-line-purple::before {
        background: linear-gradient(90deg, transparent, #9333ea, #3b82f6, transparent);
    }
    
    /* Top border */
    .border-line-top {
        height: 1px;
        left: 0;
        right: 0;
        top: 0;
    }
    
    .border-line-top::before {
        top: 0;
        left: -200%;
    }
    
    /* Right border */
    .border-line-right {
        width: 1px;
        right: 0;
        top: 0;
        bottom: 0;
    }
    
    .border-line-right::before {
        width: 1px;
        height: 300%;
        top: -200%;
        right: 0;
    }
    
    /* Bottom border */
    .border-line-bottom {
        height: 1px;
        right: 0;
        bottom: 0;
        left: 0;
    }
    
    .border-line-bottom::before {
        bottom: 0;
        right: -200%;
    }
    
    /* Left border */
    .border-line-left {
        width: 1px;
        left: 0;
        bottom: 0;
        top: 0;
    }
    
    .border-line-left::before {
        width: 1px;
        height: 300%;
        bottom: -200%;
        left: 0;
    }
    
    /* Animation for each border line */
    .group:hover .border-line-top::before {
        animation: slide-right 1.5s linear infinite;
    }
    
    .group:hover .border-line-right::before {
        animation: slide-down 1.5s linear 0.375s infinite;
    }
    
    .group:hover .border-line-bottom::before {
        animation: slide-left 1.5s linear 0.75s infinite;
    }
    
    .group:hover .border-line-left::before {
        animation: slide-up 1.5s linear 1.125s infinite;
    }
    
    @keyframes slide-right {
        from { transform: translateX(-100%); }
        to { transform: translateX(100%); }
    }
    
    @keyframes slide-down {
        from { transform: translateY(-100%); }
        to { transform: translateY(100%); }
    }
    
    @keyframes slide-left {
        from { transform: translateX(100%); }
        to { transform: translateX(-100%); }
    }
    
    @keyframes slide-up {
        from { transform: translateY(100%); }
        to { transform: translateY(-100%); }
    }
    
    /* Ensure content is above the border */
    .relative.z-10, .relative {
        z-index: 2;
    }
    
    /* Fix for testimonials and other content */
    .absolute.top-4.left-4 {
        z-index: 2;
    }
    
    /* Theme toggle animations */
    @keyframes rotate-360 {
        from { transform: translate(-50%, -50%) rotate(0deg); }
        to { transform: translate(-50%, -50%) rotate(360deg); }
    }
    
    @keyframes rotate-negative-360 {
        from { transform: translate(-50%, -50%) rotate(0deg); }
        to { transform: translate(-50%, -50%) rotate(-360deg); }
    }
    
    .rotate-360 {
        animation: rotate-360 0.5s ease-in-out;
    }
    
    .rotate-negative-360 {
        animation: rotate-negative-360 0.5s ease-in-out;
    }
    
    /* Theme toggle click animation */
    .theme-toggle-clicked {
        animation: toggle-pulse 0.3s ease-in-out;
    }
    
    @keyframes toggle-pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
</style>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MotionStack Design</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=exo-2:400,500,600,700|raleway:300,400,500,600" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        <script src="https://unpkg.com/@motionone/dom@10.16.2/dist/motion-one-dom.min.js"></script>

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body x-data="{darkMode: true}" :class="darkMode ? 'dark' : ''" class="font-raleway bg-white dark:bg-[#04041F] text-slate-900 dark:text-white flex p-0 items-center justify-center min-h-screen flex-col antialiased selection:bg-purple-500/10 dark:selection:bg-blue-500/10 overflow-x-hidden transition-colors duration-500">
        <!-- Navigation -->
        <header class="fixed top-0 w-full z-50 transition-all duration-300 backdrop-blur-sm bg-white/80 dark:bg-[#04041F]/80 border-b border-transparent" 
               x-data="{isScrolled: false}"
               x-init="window.addEventListener('scroll', () => { isScrolled = window.scrollY > 20 })"
               :class="{'border-slate-200/50 dark:border-white/10 shadow-lg': isScrolled}">
            <div class="container mx-auto px-6 py-4">
                <nav class="flex items-center justify-between">
                    <!-- Logo -->
                    <a href="#" class="flex items-center space-x-2">
                        <img src="{{ asset('images/ms-logo-white-text.svg') }}" alt="MotionStack Design" class="h-10 hidden dark:block">
                        <img src="{{ asset('images/ms-logo-black-text.svg') }}" alt="MotionStack Design" class="h-10 block dark:hidden">
                    </a>
                    
                    <!-- Navigation Links -->
                    <div class="hidden md:flex items-center space-x-8 text-sm font-medium">
                        <a href="#services" class="text-slate-700 dark:text-white/80 hover:text-purple-600 dark:hover:text-blue-400 transition-colors">Services</a>
                        <a href="#about" class="text-slate-700 dark:text-white/80 hover:text-purple-600 dark:hover:text-blue-400 transition-colors">Why Choose Us</a>
                        <a href="#portfolio" class="text-slate-700 dark:text-white/80 hover:text-purple-600 dark:hover:text-blue-400 transition-colors">Portfolio</a>
                        <a href="#testimonials" class="text-slate-700 dark:text-white/80 hover:text-purple-600 dark:hover:text-blue-400 transition-colors">Testimonials</a>
                    </div>
                    
                    <!-- CTA Button & Theme Toggle -->
                    <div class="flex items-center space-x-4">
                        <button @click="darkMode = !darkMode; $event.target.closest('button').classList.add('theme-toggle-clicked'); setTimeout(() => {$event.target.closest('button').classList.remove('theme-toggle-clicked')}, 300)" 
                                class="relative w-12 h-6 rounded-full bg-gradient-to-r from-blue-500/20 to-purple-600/20 dark:from-blue-500/30 dark:to-purple-600/30 backdrop-blur-sm border border-slate-200/50 dark:border-white/20 p-0.5 overflow-hidden transition-all duration-500 hover:shadow-md hover:shadow-purple-500/10 group"
                                x-init="$watch('darkMode', value => {
                                    if (value) {
                                        localStorage.setItem('darkMode', 'true');
                                        document.documentElement.classList.add('dark');
                                    } else {
                                        localStorage.setItem('darkMode', 'false');
                                        document.documentElement.classList.remove('dark');
                                    }
                                });
                                darkMode = localStorage.getItem('darkMode') === 'false' ? false : true;">
                            <!-- Animated background effect -->
                            <span class="absolute inset-0 overflow-hidden rounded-full">
                                <span class="absolute inset-0 opacity-0 dark:opacity-100 transition-opacity duration-500 bg-gradient-to-r from-blue-600/20 to-purple-700/20"></span>
                                <!-- Light mode stars (visible in dark mode) -->
                                <span class="absolute inset-0 opacity-0 dark:opacity-30 transition-opacity duration-500">
                                    <span class="absolute top-1 left-1 w-0.5 h-0.5 bg-white rounded-full animate-pulse"></span>
                                    <span class="absolute top-3 left-4 w-0.5 h-0.5 bg-white rounded-full animate-pulse delay-300"></span>
                                    <span class="absolute top-2 left-8 w-0.5 h-0.5 bg-white rounded-full animate-pulse delay-500"></span>
                                </span>
                                <!-- Sun rays (visible in light mode) -->
                                <span class="absolute inset-0 opacity-30 dark:opacity-0 transition-opacity duration-500">
                                    <span class="absolute top-0 left-2 w-8 h-0.5 bg-amber-300/30 rounded-full transform -rotate-45 origin-left"></span>
                                    <span class="absolute bottom-0 left-2 w-8 h-0.5 bg-amber-300/30 rounded-full transform rotate-45 origin-left"></span>
                                </span>
                            </span>
                            <!-- Toggle knob with icons -->
                            <span class="block w-5 h-5 rounded-full bg-white dark:bg-slate-800 shadow-md transform transition-transform duration-500 ease-in-out" 
                                  :class="darkMode ? 'translate-x-6' : 'translate-x-0'">
                                <!-- Moon icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-slate-400 opacity-0 dark:opacity-100 transition-all duration-500 transform rotate-0 dark:rotate-360" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                </svg>
                                <!-- Sun icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-amber-400 opacity-100 dark:opacity-0 transition-all duration-500 transform rotate-0 dark:-rotate-360" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </span>
                        </button>
                        <a href="#contact" class="hidden md:block px-6 py-2.5 bg-gradient-to-r from-purple-600 to-blue-500 hover:from-purple-700 hover:to-blue-600 text-white rounded-md font-medium transition-all duration-300 transform hover:scale-105 hover:shadow-lg hover:shadow-purple-500/20">
                            Get in Touch
                        </a>
                        <!-- Mobile Menu Button -->
                        <button class="md:hidden p-2 rounded-md text-slate-700 dark:text-white/80 hover:bg-slate-200 dark:hover:bg-slate-800 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </nav>
            </div>
        </header>
        <!-- Main Content -->
        <div class="flex flex-col w-full transition-opacity opacity-100 duration-750 starting:opacity-0">
            <main class="w-full">
                <!-- Hero Section -->
                <section class="relative min-h-screen flex items-center overflow-hidden pt-32 pb-20 px-6">
                    <!-- Background Gradients -->
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full bg-purple-600/10 dark:bg-purple-600/30 blur-3xl"></div>
                        <div class="absolute top-40 -left-40 w-96 h-96 rounded-full bg-blue-600/10 dark:bg-blue-600/30 blur-3xl"></div>
                        <div class="absolute bottom-0 left-1/2 w-full h-1/2 bg-gradient-to-t from-white/80 dark:from-[#04041F]/80 to-transparent"></div>
                    </div>
                    
                    <!-- Hero Content -->
                    <div class="relative z-10 max-w-7xl mx-auto w-full">
                        <div class="flex flex-col lg:flex-row items-center gap-12">
                            <div class="lg:w-1/2">
                                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-purple-600">
                                    Crafting Tailored <span class="block">Software Solutions</span> for Your Business
                                </h1>
                                <p class="text-lg md:text-xl max-w-2xl mb-10 text-slate-700 dark:text-zinc-300">
                                    From web and mobile apps to video production and UI design, we deliver excellence across the board.                            
                                </p>
                                <p class="text-sm md:text-base text-zinc-400 mb-6">
                                    <span class="text-blue-400 font-medium">Trusted by Businesses Worldwide</span>
                                </p>
                                <div class="flex flex-col sm:flex-row gap-4">
                                    <a href="#services" class="px-8 py-3 rounded-md bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/20 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-[#04041F] focus:ring-offset-white">
                                        Get a Free Consultation
                                    </a>
                                    <a href="#portfolio" class="px-8 py-3 rounded-md bg-transparent border-2 border-blue-400 text-slate-700 dark:text-white font-medium transition-all duration-300 hover:border-purple-500 hover:bg-white/5 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 dark:focus:ring-offset-[#04041F] focus:ring-offset-white">
                                        View Our Work
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Animated Preview -->
                            <div class="lg:w-1/2 flex justify-center">
                                <div class="relative w-full max-w-md">
                                    <!-- App Interface Mockup -->
                                    <div class="relative z-10 bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl overflow-hidden shadow-2xl">
                                        <div class="pt-4 px-4 pb-6 bg-[#04041F]">
                                            <div class="flex items-center justify-between mb-2">
                                                <div class="flex space-x-1">
                                                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                                    <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                                </div>
                                                <div class="h-5 w-32 rounded-md bg-slate-700 flex items-center justify-center">
                                                    <div class="w-24 h-3 bg-gradient-to-r from-blue-500/50 to-purple-600/50 rounded-full animate-pulse"></div>
                                                </div>
                                            </div>
                                            <div class="aspect-video rounded-md overflow-hidden bg-slate-800 flex flex-col items-center justify-center relative">
                                                <!-- Dashboard UI Mockup -->
                                                <div class="absolute inset-0 bg-gradient-to-br from-slate-900 to-slate-800 opacity-90"></div>
                                                <div class="relative z-10 w-full h-full p-3">
                                                    <!-- Top Nav -->
                                                    <div class="flex justify-between items-center mb-4">
                                                        <div class="w-24 h-6 bg-gradient-to-r from-blue-500/40 to-purple-600/40 rounded-md"></div>
                                                        <div class="flex space-x-2">
                                                            <div class="w-6 h-6 rounded-full bg-blue-500/30"></div>
                                                            <div class="w-6 h-6 rounded-full bg-purple-500/30"></div>
                                                        </div>
                                                    </div>
                                                    <!-- Content -->
                                                    <div class="flex space-x-3">
                                                        <!-- Sidebar -->
                                                        <div class="w-1/4">
                                                            <div class="w-full h-4 bg-blue-500/20 rounded mb-2"></div>
                                                            <div class="w-full h-4 bg-purple-500/30 rounded mb-2"></div>
                                                            <div class="w-full h-4 bg-blue-500/20 rounded mb-2"></div>
                                                            <div class="w-full h-4 bg-blue-500/20 rounded mb-2"></div>
                                                            <div class="w-full h-4 bg-purple-500/30 rounded"></div>
                                                        </div>
                                                        <!-- Main Content -->
                                                        <div class="w-3/4">
                                                            <div class="w-full h-24 bg-gradient-to-r from-blue-500/20 to-purple-600/20 rounded-lg mb-3 flex items-center justify-center">
                                                                <div class="w-3/4 h-3 bg-white/20 rounded-full"></div>
                                                            </div>
                                                            <div class="grid grid-cols-2 gap-2">
                                                                <div class="h-12 bg-blue-500/20 rounded-md"></div>
                                                                <div class="h-12 bg-purple-500/20 rounded-md"></div>
                                                                <div class="h-12 bg-purple-500/20 rounded-md"></div>
                                                                <div class="h-12 bg-blue-500/20 rounded-md"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Animated Code Line -->
                                                    <div class="absolute bottom-3 left-3 right-3 h-5 bg-slate-900/60 rounded overflow-hidden">
                                                        <div class="h-full w-full flex items-center">
                                                            <div class="h-2 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full animate-[gradient-x_3s_ease_infinite] w-[200%] -ml-full"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Decorative Elements -->
                                    <div class="absolute -bottom-6 -right-6 w-64 h-64 bg-gradient-to-br from-blue-500/30 to-purple-600/30 rounded-full blur-3xl -z-10"></div>
                                    <div class="absolute -top-6 -left-6 w-64 h-64 bg-gradient-to-br from-purple-600/20 to-blue-500/20 rounded-full blur-3xl -z-10"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Services Section -->
                <section id="services" class="relative py-20 px-6 overflow-hidden">
                    <!-- Background Gradients -->
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="absolute -top-20 right-20 w-72 h-72 rounded-full bg-purple-600/5 dark:bg-purple-600/20 blur-3xl"></div>
                        <div class="absolute bottom-40 left-20 w-72 h-72 rounded-full bg-blue-600/5 dark:bg-blue-600/20 blur-3xl"></div>
                    </div>
                    
                    <div class="relative z-10 max-w-7xl mx-auto">
                        <!-- Section Header -->
                        <div class="text-center mb-16">
                            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 font-exo">Comprehensive <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-purple-600">Software Solutions</span> for Every Need</h2>
                            <p class="text-lg text-slate-600 dark:text-zinc-400 max-w-2xl mx-auto">We build, create, and design with precision to drive your business forward.</p>
                        </div>
                        
                        <!-- Services Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                            <!-- Service Card 1 -->
                            <div class="group relative bg-white/80 dark:bg-white/5 backdrop-blur-sm border border-slate-200/50 dark:border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/90 dark:hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10">
                                <div class="animated-border">
                                    <div class="border-line border-line-top"></div>
                                    <div class="border-line border-line-right"></div>
                                    <div class="border-line border-line-bottom"></div>
                                    <div class="border-line border-line-left"></div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-purple-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative z-10 p-1 bg-gradient-to-r from-blue-500/80 to-purple-600/80"></div>
                                <div class="p-6 relative z-10">
                                    <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-purple-600/20 to-blue-500/20 backdrop-blur-sm flex items-center justify-center mb-6 mx-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold mb-3 text-center font-exo">Video Production</h3>
                                    <p class="text-slate-600 dark:text-zinc-400 mb-6 text-center">From engaging intros to full-length corporate videos, we craft content that captivates—ready to scale for your biggest projects.</p>
                                    <div class="text-center">
                                        <a href="#contact" class="px-6 py-2 rounded-md bg-slate-100 dark:bg-white/10 hover:bg-gradient-to-r hover:from-purple-600 hover:to-blue-500 text-slate-700 dark:text-white font-medium transition-all duration-300 inline-flex items-center hover:text-white">
                                            Get a Quote
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Service Card 2 -->
                            <div class="group relative bg-white/80 dark:bg-white/5 backdrop-blur-sm border border-slate-200/50 dark:border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/90 dark:hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10">
                                <div class="animated-border animated-border-purple">
                                    <div class="border-line border-line-top border-line-purple"></div>
                                    <div class="border-line border-line-right border-line-purple"></div>
                                    <div class="border-line border-line-bottom border-line-purple"></div>
                                    <div class="border-line border-line-left border-line-purple"></div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-purple-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative z-10 p-1 bg-gradient-to-r from-blue-500/80 to-purple-600/80"></div>
                                <div class="p-6 relative z-10">
                                    <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-blue-500/20 to-purple-600/20 backdrop-blur-sm flex items-center justify-center mb-6 mx-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold mb-3 text-center font-exo">Mobile & Desktop Apps</h3>
                                    <p class="text-slate-600 dark:text-zinc-400 mb-6 text-center">Native and cross-platform applications built with Flutter, React Native, and NativePHP, delivering exceptional user experiences across all devices.</p>
                                    <div class="text-center">
                                        <a href="#contact" class="px-6 py-2 rounded-md bg-slate-100 dark:bg-white/10 hover:bg-gradient-to-r hover:from-blue-500 hover:to-purple-600 text-slate-700 dark:text-white font-medium transition-all duration-300 inline-flex items-center hover:text-white">
                                            Get a Quote
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Service Card 3 -->
                            <div class="group relative bg-white/80 dark:bg-white/5 backdrop-blur-sm border border-slate-200/50 dark:border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/90 dark:hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10">
                                <div class="animated-border">
                                    <div class="border-line border-line-top"></div>
                                    <div class="border-line border-line-right"></div>
                                    <div class="border-line border-line-bottom"></div>
                                    <div class="border-line border-line-left"></div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-purple-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative z-10 p-1 bg-gradient-to-r from-blue-500/80 to-purple-600/80"></div>
                                <div class="p-6 relative z-10">
                                    <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-purple-600/20 to-blue-500/20 backdrop-blur-sm flex items-center justify-center mb-6 mx-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold mb-3 text-center font-exo">Web Applications</h3>
                                    <p class="text-slate-600 dark:text-zinc-400 mb-6 text-center">Modern, responsive web applications built with industry-leading frameworks like Laravel and Nuxt for seamless performance.</p>
                                    <div class="text-center">
                                        <a href="#contact" class="px-6 py-2 rounded-md bg-slate-100 dark:bg-white/10 hover:bg-gradient-to-r hover:from-purple-600 hover:to-blue-500 text-slate-700 dark:text-white font-medium transition-all duration-300 inline-flex items-center hover:text-white">
                                            Get a Quote
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Service Card 4 -->
                            <div class="group relative bg-white/80 dark:bg-white/5 backdrop-blur-sm border border-slate-200/50 dark:border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/90 dark:hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10">
                                <div class="animated-border animated-border-purple">
                                    <div class="border-line border-line-top border-line-purple"></div>
                                    <div class="border-line border-line-right border-line-purple"></div>
                                    <div class="border-line border-line-bottom border-line-purple"></div>
                                    <div class="border-line border-line-left border-line-purple"></div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-purple-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative z-10 p-1 bg-gradient-to-r from-blue-500/80 to-purple-600/80"></div>
                                <div class="p-6 relative z-10">
                                    <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-blue-500/20 to-purple-600/20 backdrop-blur-sm flex items-center justify-center mb-6 mx-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold mb-3 text-center font-exo">Development</h3>
                                    <p class="text-slate-600 dark:text-zinc-400 mb-6 text-center">We build robust and scalable software solutions using cutting-edge technologies like Laravel, Nuxt, Flutter, NativePHP, and Tauri.</p>
                                    <div class="text-center">
                                        <a href="#contact" class="px-6 py-2 rounded-md bg-slate-100 dark:bg-white/10 hover:bg-gradient-to-r hover:from-blue-500 hover:to-purple-600 text-slate-700 dark:text-white font-medium transition-all duration-300 inline-flex items-center hover:text-white">
                                            Get a Quote
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Service Card 5 -->
                            <div class="group relative bg-white/80 dark:bg-white/5 backdrop-blur-sm border border-slate-200/50 dark:border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/90 dark:hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10">
                                <div class="animated-border">
                                    <div class="border-line border-line-top"></div>
                                    <div class="border-line border-line-right"></div>
                                    <div class="border-line border-line-bottom"></div>
                                    <div class="border-line border-line-left"></div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-purple-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative z-10 p-1 bg-gradient-to-r from-blue-500/80 to-purple-600/80"></div>
                                <div class="p-6 relative z-10">
                                    <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-purple-600/20 to-blue-500/20 backdrop-blur-sm flex items-center justify-center mb-6 mx-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold mb-3 text-center font-exo">UI/UX Design</h3>
                                    <p class="text-slate-600 dark:text-zinc-400 mb-6 text-center">We design intuitive, user-friendly interfaces using Figma and Penpot, ensuring your software looks as good as it performs.</p>
                                    <div class="text-center">
                                        <a href="#contact" class="px-6 py-2 rounded-md bg-slate-100 dark:bg-white/10 hover:bg-gradient-to-r hover:from-purple-600 hover:to-blue-500 text-slate-700 dark:text-white font-medium transition-all duration-300 inline-flex items-center hover:text-white">
                                            Get a Quote
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Service Card 6 -->
                            <div class="group relative bg-white/80 dark:bg-white/5 backdrop-blur-sm border border-slate-200/50 dark:border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/90 dark:hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10">
                                <div class="animated-border animated-border-purple">
                                    <div class="border-line border-line-top border-line-purple"></div>
                                    <div class="border-line border-line-right border-line-purple"></div>
                                    <div class="border-line border-line-bottom border-line-purple"></div>
                                    <div class="border-line border-line-left border-line-purple"></div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-purple-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative z-10 p-1 bg-gradient-to-r from-blue-500/80 to-purple-600/80"></div>
                                <div class="p-6 relative z-10">
                                    <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-blue-500/20 to-purple-600/20 backdrop-blur-sm flex items-center justify-center mb-6 mx-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold mb-3 text-center font-exo">Desktop Apps</h3>
                                    <p class="text-slate-600 dark:text-zinc-400 mb-6 text-center">Cross-platform desktop applications using NativePHP and Tauri that offer native performance with web technologies you already know.</p>
                                    <div class="text-center">
                                        <a href="#contact" class="px-6 py-2 rounded-md bg-slate-100 dark:bg-white/10 hover:bg-gradient-to-r hover:from-blue-500 hover:to-purple-600 text-slate-700 dark:text-white font-medium transition-all duration-300 inline-flex items-center hover:text-white">
                                            Get a Quote
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Service Card 5 - Mobile Apps -->
                            <div class="group relative bg-white/80 dark:bg-white/5 backdrop-blur-sm border border-slate-200/50 dark:border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/90 dark:hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10">
                                <div class="animated-border">
                                    <div></div><div></div><div></div><div></div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-purple-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative z-10 p-1 bg-gradient-to-r from-blue-500/80 to-purple-600/80"></div>
                                <div class="p-6 relative z-10">
                                    <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-purple-600/20 to-blue-500/20 backdrop-blur-sm flex items-center justify-center mb-6 mx-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold mb-3 text-center font-exo">Mobile Apps</h3>
                                    <p class="text-slate-600 dark:text-zinc-400 mb-6 text-center">Native and cross-platform mobile applications built with Flutter and React Native for iOS and Android devices.</p>
                                    <div class="text-center">
                                        <a href="#contact" class="px-6 py-2 rounded-md bg-slate-100 dark:bg-white/10 hover:bg-gradient-to-r hover:from-purple-600 hover:to-blue-500 text-slate-700 dark:text-white font-medium transition-all duration-300 inline-flex items-center hover:text-white">
                                            Get a Quote
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Service Card 6 - Video Production -->
                            <div class="group relative bg-white/80 dark:bg-white/5 backdrop-blur-sm border border-slate-200/50 dark:border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/90 dark:hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10">
                                <div class="animated-border">
                                    <div></div><div></div><div></div><div></div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-purple-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative z-10 p-1 bg-gradient-to-r from-blue-500/80 to-purple-600/80"></div>
                                <div class="p-6 relative z-10">
                                    <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-blue-500/20 to-purple-600/20 backdrop-blur-sm flex items-center justify-center mb-6 mx-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold mb-3 text-center font-exo">Video Production</h3>
                                    <p class="text-slate-600 dark:text-zinc-400 mb-6 text-center">Engaging corporate videos, product demos, and explainer animations that communicate your message effectively.</p>
                                    <div class="text-center">
                                        <a href="#contact" class="px-6 py-2 rounded-md bg-slate-100 dark:bg-white/10 hover:bg-gradient-to-r hover:from-blue-500 hover:to-purple-600 text-slate-700 dark:text-white font-medium transition-all duration-300 inline-flex items-center hover:text-white">
                                            Get a Quote
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- CTA Button -->
                        <div class="mt-12 text-center">
                            <a href="#contact" class="inline-block px-8 py-3 rounded-md bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-purple-500/20 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-[#04041F] focus:ring-offset-white">
                                Get a Custom Quote
                            </a>
                        </div>
                    </div>
                </section>
                
                <!-- Why Choose Us Section -->
                <section id="about" class="relative py-20 px-6 overflow-hidden">
                    <!-- Background Gradients -->
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="absolute -top-20 left-20 w-72 h-72 rounded-full bg-blue-600/20 blur-3xl"></div>
                        <div class="absolute bottom-40 right-20 w-72 h-72 rounded-full bg-purple-600/20 blur-3xl"></div>
                    </div>
                    
                    <div class="relative z-10 max-w-7xl mx-auto">
                        <div class="flex flex-col lg:flex-row items-center gap-16">
                            <!-- Left Column: Image -->
                            <div class="lg:w-1/2 order-2 lg:order-1">
                                <div class="relative">
                                    <!-- Main Image with Glass Effect -->
                                    <div class="relative rounded-xl overflow-hidden bg-white/5 backdrop-blur-sm border border-white/10 shadow-2xl">
                                        <div class="p-1 bg-gradient-to-r from-blue-500/80 to-purple-600/80"></div>
                                        <div class="aspect-video bg-zinc-800 rounded-lg flex items-center justify-center p-8">
                                            <div class="grid grid-cols-2 gap-4 w-full">
                                                <div class="aspect-square bg-white/10 rounded-lg flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                                    </svg>
                                                </div>
                                                <div class="aspect-square bg-white/10 rounded-lg flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                                                    </svg>
                                                </div>
                                                <div class="aspect-square bg-white/10 rounded-lg flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                                <div class="aspect-square bg-white/10 rounded-lg flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Decorative Elements -->
                                    <div class="absolute -top-6 -right-6 w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg">
                                        <div class="w-10 h-10 rounded-full bg-[#04041F] flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="absolute -bottom-6 -left-6 w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg">
                                        <div class="w-10 h-10 rounded-full bg-[#04041F] flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Right Column: Content -->
                            <div class="lg:w-1/2 order-1 lg:order-2">
                                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6 font-exo">Why <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-purple-600">Partner with MotionStack</span>?</h2>
                                <p class="text-lg text-slate-600 dark:text-zinc-400 mb-8">We're not just developers – we're strategic partners committed to transforming your vision into powerful software solutions.</p>
                                
                                <!-- Features List -->
                                <div class="space-y-6">
                                    <!-- Feature 1 -->
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-slate-100/80 dark:bg-white/10 flex items-center justify-center mr-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-xl font-bold mb-2 font-exo">Technical Excellence</h4>
                                            <p class="text-slate-600 dark:text-zinc-400">Our team brings years of expertise in modern frameworks like Laravel, Flutter, and React, ensuring your project is built with industry best practices.</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Feature 2 -->
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-slate-100/80 dark:bg-white/10 flex items-center justify-center mr-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-xl font-bold mb-2 font-exo">Tailored Solutions</h4>
                                            <p class="text-slate-600 dark:text-zinc-400">We don't believe in one-size-fits-all. Every solution we build is custom-designed to address your specific business challenges and goals.</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Feature 3 -->
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-slate-100/80 dark:bg-white/10 flex items-center justify-center mr-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-xl font-bold mb-2 font-exo">Transparent Communication</h4>
                                            <p class="text-slate-600 dark:text-zinc-400">We maintain clear, consistent communication throughout your project, ensuring you're always informed and involved in the development process.</p>
                                        </div>
                                    </div>
                                    <!-- Feature 4 -->
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-slate-100/80 dark:bg-white/10 flex items-center justify-center mr-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-xl font-bold mb-2 font-exo">End-to-End Service</h4>
                                            <p class="text-slate-600 dark:text-zinc-400">From concept to completion, we handle every aspect of your project with meticulous attention to detail and quality assurance.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Portfolio Section -->
                <section id="portfolio" class="relative py-20 px-6 overflow-hidden">
                    <!-- Background Gradients -->
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="absolute top-20 -right-20 w-72 h-72 rounded-full bg-purple-600/20 blur-3xl"></div>
                        <div class="absolute bottom-20 -left-20 w-72 h-72 rounded-full bg-blue-600/20 blur-3xl"></div>
                    </div>
                    
                    <div class="relative z-10 max-w-7xl mx-auto">
                        <!-- Section Header -->
                        <div class="text-center mb-16">
                            <h2 class="text-3xl md:text-4xl font-bold mb-4">Our <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-purple-600">Portfolio</span></h2>
                            <p class="text-lg text-slate-600 dark:text-zinc-400 max-w-2xl mx-auto">Explore our latest motion design projects and see how we bring brands to life through animation.</p>
                        </div>
                        
                        <!-- Portfolio Filter -->
                        <div class="flex flex-wrap justify-center gap-2 mb-12">
                            <button class="px-4 py-2 rounded-md bg-blue-500/10 dark:bg-white/10 backdrop-blur-sm border border-blue-400/20 dark:border-white/20 text-slate-700 dark:text-white font-medium transition-all hover:bg-blue-500/20 dark:hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-white/20 focus:ring-offset-2 dark:focus:ring-offset-[#04041F] focus:ring-offset-white active">
                                All Projects
                            </button>
                            <button class="px-4 py-2 rounded-md bg-transparent border border-slate-300/50 dark:border-white/10 text-slate-600 dark:text-zinc-400 font-medium transition-all hover:bg-slate-100 dark:hover:bg-white/5 hover:text-slate-800 dark:hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-white/20 focus:ring-offset-2 dark:focus:ring-offset-[#04041F] focus:ring-offset-white">
                                UI Animation
                            </button>
                            <button class="px-4 py-2 rounded-md bg-transparent border border-slate-300/50 dark:border-white/10 text-slate-600 dark:text-zinc-400 font-medium transition-all hover:bg-slate-100 dark:hover:bg-white/5 hover:text-slate-800 dark:hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-white/20 focus:ring-offset-2 dark:focus:ring-offset-[#04041F] focus:ring-offset-white">
                                Explainer Videos
                            </button>
                            <button class="px-4 py-2 rounded-md bg-transparent border border-slate-300/50 dark:border-white/10 text-slate-600 dark:text-zinc-400 font-medium transition-all hover:bg-slate-100 dark:hover:bg-white/5 hover:text-slate-800 dark:hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-white/20 focus:ring-offset-2 dark:focus:ring-offset-[#04041F] focus:ring-offset-white">
                                Logo Animation
                            </button>
                        </div>
                        
                        <!-- Portfolio Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                            <!-- Portfolio Item 1 -->
                            <div class="group relative overflow-hidden rounded-xl bg-white/5 backdrop-blur-sm border border-white/10 transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10">
                                <div class="animated-border">
                                    <div class="border-line border-line-top"></div>
                                    <div class="border-line border-line-right"></div>
                                    <div class="border-line border-line-bottom"></div>
                                    <div class="border-line border-line-left"></div>
                                </div>
                                <div class="aspect-video bg-zinc-800 overflow-hidden">
                                    <!-- This would be a video or animation preview -->
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-900/50 to-purple-900/50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-[#04041F] via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                                    <div class="p-6 w-full">
                                        <h3 class="text-xl font-bold mb-2">E-Commerce App Animations</h3>
                                        <p class="text-zinc-300 mb-4">UI Animation</p>
                                        <a href="#" class="inline-flex items-center text-blue-400 hover:text-blue-300 transition-colors">
                                            View Project
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Portfolio Item 2 -->
                            <div class="group relative overflow-hidden rounded-xl bg-white/5 backdrop-blur-sm border border-white/10 transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10">
                                <div class="animated-border animated-border-purple">
                                    <div class="border-line border-line-top border-line-purple"></div>
                                    <div class="border-line border-line-right border-line-purple"></div>
                                    <div class="border-line border-line-bottom border-line-purple"></div>
                                    <div class="border-line border-line-left border-line-purple"></div>
                                </div>
                                <div class="aspect-video bg-zinc-800 overflow-hidden">
                                    <!-- This would be a video or animation preview -->
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-purple-900/50 to-blue-900/50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-[#04041F] via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                                    <div class="p-6 w-full">
                                        <h3 class="text-xl font-bold mb-2">SaaS Product Explainer</h3>
                                        <p class="text-zinc-300 mb-4">Explainer Video</p>
                                        <a href="#" class="inline-flex items-center text-purple-400 hover:text-purple-300 transition-colors">
                                            View Project
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Portfolio Item 3 -->
                            <div class="group relative overflow-hidden rounded-xl bg-white/5 backdrop-blur-sm border border-white/10 transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10">
                                <div class="animated-border">
                                    <div class="border-line border-line-top"></div>
                                    <div class="border-line border-line-right"></div>
                                    <div class="border-line border-line-bottom"></div>
                                    <div class="border-line border-line-left"></div>
                                </div>
                                <div class="aspect-video bg-zinc-800 overflow-hidden">
                                    <!-- This would be a video or animation preview -->
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-900/50 to-purple-900/50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-[#04041F] via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                                    <div class="p-6 w-full">
                                        <h3 class="text-xl font-bold mb-2">Tech Startup Logo Animation</h3>
                                        <p class="text-zinc-300 mb-4">Logo Animation</p>
                                        <a href="#" class="inline-flex items-center text-blue-400 hover:text-blue-300 transition-colors">
                                            View Project
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Portfolio Item 4 -->
                            <div class="group relative overflow-hidden rounded-xl bg-white/5 backdrop-blur-sm border border-white/10 transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10">
                                <div class="animated-border animated-border-purple">
                                    <div class="border-line border-line-top border-line-purple"></div>
                                    <div class="border-line border-line-right border-line-purple"></div>
                                    <div class="border-line border-line-bottom border-line-purple"></div>
                                    <div class="border-line border-line-left border-line-purple"></div>
                                </div>
                                <div class="aspect-video bg-zinc-800 overflow-hidden">
                                    <!-- This would be a video or animation preview -->
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-purple-900/50 to-blue-900/50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-[#04041F] via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                                    <div class="p-6 w-full">
                                        <h3 class="text-xl font-bold mb-2">Social Media Campaign</h3>
                                        <p class="text-zinc-300 mb-4">Social Media Content</p>
                                        <a href="#" class="inline-flex items-center text-purple-400 hover:text-purple-300 transition-colors">
                                            View Project
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Portfolio Item 5 -->
                            <div class="group relative overflow-hidden rounded-xl bg-white/5 backdrop-blur-sm border border-white/10 transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10">
                                <div class="animated-border">
                                    <div class="border-line border-line-top"></div>
                                    <div class="border-line border-line-right"></div>
                                    <div class="border-line border-line-bottom"></div>
                                    <div class="border-line border-line-left"></div>
                                </div>
                                <div class="aspect-video bg-zinc-800 overflow-hidden">
                                    <!-- This would be a video or animation preview -->
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-900/50 to-purple-900/50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-[#04041F] via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                                    <div class="p-6 w-full">
                                        <h3 class="text-xl font-bold mb-2">Character Animation Series</h3>
                                        <p class="text-zinc-300 mb-4">Character Animation</p>
                                        <a href="#" class="inline-flex items-center text-blue-400 hover:text-blue-300 transition-colors">
                                            View Project
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Portfolio Item 6 -->
                            <div class="group relative overflow-hidden rounded-xl bg-white/5 backdrop-blur-sm border border-white/10 transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10">
                                <div class="animated-border animated-border-purple">
                                    <div class="border-line border-line-top border-line-purple"></div>
                                    <div class="border-line border-line-right border-line-purple"></div>
                                    <div class="border-line border-line-bottom border-line-purple"></div>
                                    <div class="border-line border-line-left border-line-purple"></div>
                                </div>
                                <div class="aspect-video bg-zinc-800 overflow-hidden">
                                    <!-- This would be a video or animation preview -->
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-purple-900/50 to-blue-900/50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-[#04041F] via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                                    <div class="p-6 w-full">
                                        <h3 class="text-xl font-bold mb-2">Interactive Product Demo</h3>
                                        <p class="text-zinc-300 mb-4">Motion Graphics</p>
                                        <a href="#" class="inline-flex items-center text-purple-400 hover:text-purple-300 transition-colors">
                                            View Project
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- View More Button -->
                        <div class="mt-12 text-center">
                            <a href="#" class="inline-block px-8 py-3 rounded-md bg-white/10 backdrop-blur-md border border-white/20 text-white font-medium transition-all hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white/20 focus:ring-offset-2 focus:ring-offset-[#04041F]">
                                View More Projects
                            </a>
                        </div>
                    </div>
                </section>
                
                <!-- Testimonials Section -->
                <section id="testimonials" class="relative py-20 px-6 overflow-hidden">
                    <!-- Background Gradients -->
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="absolute -top-20 -right-20 w-72 h-72 rounded-full bg-blue-600/20 blur-3xl"></div>
                        <div class="absolute bottom-20 left-20 w-72 h-72 rounded-full bg-purple-600/20 blur-3xl"></div>
                    </div>
                    
                    <div class="relative z-10 max-w-7xl mx-auto">
                        <!-- Section Header -->
                        <div class="text-center mb-16">
                            <h2 class="text-3xl md:text-4xl font-bold mb-4">Client <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-purple-600">Testimonials</span></h2>
                            <p class="text-lg text-slate-600 dark:text-zinc-400 max-w-2xl mx-auto">Don't just take our word for it. Here's what our clients have to say about working with MotionStack.</p>
                        </div>
                        
                        <!-- Testimonials Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                            <!-- Testimonial 1 -->
                            <div class="group relative bg-white/80 dark:bg-white/5 backdrop-blur-sm border border-slate-200/50 dark:border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/90 dark:hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10 p-8">
                                <div class="animated-border">
                                    <div class="border-line border-line-top"></div>
                                    <div class="border-line border-line-right"></div>
                                    <div class="border-line border-line-bottom"></div>
                                    <div class="border-line border-line-left"></div>
                                </div>
                                <div class="absolute top-4 left-4 text-4xl text-blue-500/30 dark:text-blue-500/20">"</div>
                                <div class="relative">
                                    <p class="text-slate-700 dark:text-zinc-300 mb-6">Wow what an Amazing experience I had with motion stack he knew exactly what I wanted and what we as a group needed. Thanx man I would recommend to everyone.</p>
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center mr-4">
                                            <span class="text-white font-bold">JF</span>
                                        </div>
                                        <div>
                                            <h4 class="font-bold">Julio Fitzpatrick</h4>
                                            <p class="text-sm text-slate-500 dark:text-zinc-400">September 1, 2023</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Testimonial 2 -->
                            <div class="group relative bg-white/80 dark:bg-white/5 backdrop-blur-sm border border-slate-200/50 dark:border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/90 dark:hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10 p-8">
                                <div class="animated-border animated-border-purple">
                                    <div class="border-line border-line-top border-line-purple"></div>
                                    <div class="border-line border-line-right border-line-purple"></div>
                                    <div class="border-line border-line-bottom border-line-purple"></div>
                                    <div class="border-line border-line-left border-line-purple"></div>
                                </div>
                                <div class="absolute top-4 left-4 text-4xl text-purple-500/30 dark:text-purple-500/20">"</div>
                                <div class="relative">
                                    <p class="text-slate-700 dark:text-zinc-300 mb-6">Jacques has been exceptionally professional and creative. I do not know anything about web design and Jacques educated me on the different templates and look & feels of a website. He has dealt very calmly with me, over a period of a month back and forth, after I have given him more than 20 different changes that led to the final design of my website.</p>
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-600 to-blue-500 flex items-center justify-center mr-4">
                                            <span class="text-white font-bold">FR</span>
                                        </div>
                                        <div>
                                            <h4 class="font-bold">Francois Rademeyer</h4>
                                            <p class="text-sm text-slate-500 dark:text-zinc-400">Owner @ Minus 1 Recruitment</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Testimonial 3 -->
                            <div class="group relative bg-white/80 dark:bg-white/5 backdrop-blur-sm border border-slate-200/50 dark:border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/90 dark:hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10 p-8">
                                <div class="animated-border">
                                    <div class="border-line border-line-top"></div>
                                    <div class="border-line border-line-right"></div>
                                    <div class="border-line border-line-bottom"></div>
                                    <div class="border-line border-line-left"></div>
                                </div>
                                <div class="absolute top-4 left-4 text-4xl text-blue-500/30 dark:text-blue-500/20">"</div>
                                <div class="relative">
                                    <p class="text-slate-700 dark:text-zinc-300 mb-6">Jacques rendered excellent, professional service. He explained the process to get our website up and running step by step and the end-result surpassed our expectations. Thank you for making this process less daunting for us as a start-up business.</p>
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center mr-4">
                                            <span class="text-white font-bold">DD</span>
                                        </div>
                                        <div>
                                            <h4 class="font-bold">Dust & Daisies Guided Tours</h4>
                                            <p class="text-sm text-slate-500 dark:text-zinc-400">July 30, 2022</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Testimonial 4 -->
                            <div class="group relative bg-white/80 dark:bg-white/5 backdrop-blur-sm border border-slate-200/50 dark:border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/90 dark:hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10 p-8">
                                <div class="animated-border animated-border-purple">
                                    <div class="border-line border-line-top border-line-purple"></div>
                                    <div class="border-line border-line-right border-line-purple"></div>
                                    <div class="border-line border-line-bottom border-line-purple"></div>
                                    <div class="border-line border-line-left border-line-purple"></div>
                                </div>
                                <div class="absolute top-4 left-4 text-4xl text-purple-500/30 dark:text-purple-500/20">"</div>
                                <div class="relative">
                                    <p class="text-slate-700 dark:text-zinc-300 mb-6">Always friendly and helpful, good customer service.</p>
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-600 to-blue-500 flex items-center justify-center mr-4">
                                            <span class="text-white font-bold">JH</span>
                                        </div>
                                        <div>
                                            <h4 class="font-bold">Jennepher Hammond</h4>
                                            <p class="text-sm text-slate-500 dark:text-zinc-400">July 22, 2022</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Testimonial 5 -->
                            <div class="group relative bg-white/80 dark:bg-white/5 backdrop-blur-sm border border-slate-200/50 dark:border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/90 dark:hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10 p-8">
                                <div class="animated-border">
                                    <div class="border-line border-line-top"></div>
                                    <div class="border-line border-line-right"></div>
                                    <div class="border-line border-line-bottom"></div>
                                    <div class="border-line border-line-left"></div>
                                </div>
                                <div class="absolute top-4 left-4 text-4xl text-blue-500/30 dark:text-blue-500/20">"</div>
                                <div class="relative">
                                    <p class="text-slate-700 dark:text-zinc-300 mb-6">I have worked with Jacq for few years. He helped me with my website, YouTube channels, telegram channel, video editing, making intro and outro for video series and other things. I have found him reliable, trustworthy, creative and very helpful.</p>
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center mr-4">
                                            <span class="text-white font-bold">IA</span>
                                        </div>
                                        <div>
                                            <h4 class="font-bold">Imad Awde</h4>
                                            <p class="text-sm text-slate-500 dark:text-zinc-400">July 22, 2022</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Testimonial 6 -->
                            <div class="group relative bg-white/80 dark:bg-white/5 backdrop-blur-sm border border-slate-200/50 dark:border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/90 dark:hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10 p-8">
                                <div class="animated-border animated-border-purple">
                                    <div class="border-line border-line-top border-line-purple"></div>
                                    <div class="border-line border-line-right border-line-purple"></div>
                                    <div class="border-line border-line-bottom border-line-purple"></div>
                                    <div class="border-line border-line-left border-line-purple"></div>
                                </div>
                                <div class="absolute top-4 left-4 text-4xl text-purple-500/30 dark:text-purple-500/20">"</div>
                                <div class="relative">
                                    <p class="text-slate-700 dark:text-zinc-300 mb-6">Always a pleasure to working with them. Great customer service. I would definitely recommend Motionstack!</p>
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-600 to-blue-500 flex items-center justify-center mr-4">
                                            <span class="text-white font-bold">WS</span>
                                        </div>
                                        <div>
                                            <h4 class="font-bold">Wendy Scheffers</h4>
                                            <p class="text-sm text-slate-500 dark:text-zinc-400">July 19, 2022</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Contact Section -->
                <section id="contact" class="relative py-20 px-6 overflow-hidden">
                    <!-- Background Gradients -->
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="absolute top-20 left-20 w-72 h-72 rounded-full bg-purple-600/20 blur-3xl"></div>
                        <div class="absolute -bottom-20 -right-20 w-72 h-72 rounded-full bg-blue-600/20 blur-3xl"></div>
                    </div>
                    
                    <div class="relative z-10 max-w-7xl mx-auto">
                        <div class="flex flex-col lg:flex-row gap-16">
                            <!-- Left Column: Contact Form -->
                            <div class="lg:w-2/3">
                                <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-purple-600">Elevate Your Business</span>?</h2>
                                <p class="text-lg text-slate-600 dark:text-zinc-400 mb-8">Let's discuss how we can bring your vision to life with our software solutions.</p>
                                
                                <!-- Contact Form -->
                                <form class="space-y-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="name" class="block text-sm font-medium text-slate-700 dark:text-zinc-300 mb-2">Name</label>
                                            <input type="text" id="name" name="name" class="w-full px-4 py-3 rounded-lg bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="Your name">
                                        </div>
                                        <div>
                                            <label for="email" class="block text-sm font-medium text-slate-700 dark:text-zinc-300 mb-2">Email</label>
                                            <input type="email" id="email" name="email" class="w-full px-4 py-3 rounded-lg bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="your@email.com">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="subject" class="block text-sm font-medium text-slate-700 dark:text-zinc-300 mb-2">Subject</label>
                                        <input type="text" id="subject" name="subject" class="w-full px-4 py-3 rounded-lg bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="Project inquiry">
                                    </div>
                                    <div>
                                        <label for="message" class="block text-sm font-medium text-slate-700 dark:text-zinc-300 mb-2">Message</label>
                                        <textarea id="message" name="message" rows="5" class="w-full px-4 py-3 rounded-lg bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="Tell us about your project..."></textarea>
                                    </div>
                                    <div>
                                        <button type="submit" class="px-8 py-3 rounded-md bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium transition-transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-[#04041F] focus:ring-offset-white">
                                            Send Message
                                        </button>
                                    </div>
                                </form>
                            </div>
                            
                            <!-- Right Column: Contact Info -->
                            <div class="lg:w-1/3">
                                <div class="group relative bg-white/80 dark:bg-white/5 backdrop-blur-sm border border-slate-200/50 dark:border-white/10 rounded-xl overflow-hidden p-8">
                                    <div class="border-flow-animation"></div>
                                    <div class="border-gradient border-gradient-purple"></div>
                                    <h3 class="text-xl font-bold mb-6 font-exo">Contact Information</h3>
                                    
                                    <div class="space-y-6">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-slate-100/80 dark:bg-white/10 flex items-center justify-center mr-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-medium mb-1 text-slate-800 dark:text-white">Phone</h4>
                                                <p class="text-slate-600 dark:text-zinc-400">+27 (0)79 470-3941</p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-slate-100/80 dark:bg-white/10 flex items-center justify-center mr-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-medium mb-1 text-slate-800 dark:text-white">Email</h4>
                                                <p class="text-slate-600 dark:text-zinc-400">info@motionstack.design</p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-slate-100/80 dark:bg-white/10 flex items-center justify-center mr-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-medium mb-1 text-slate-800 dark:text-white">Location</h4>
                                                <p class="text-slate-600 dark:text-zinc-400">South Africa</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-8">
                                        <h4 class="font-medium mb-4 text-slate-800 dark:text-white">Follow Us</h4>
                                        <div class="flex space-x-4">
                                            <a href="#" class="w-10 h-10 rounded-full bg-slate-100 dark:bg-white/10 flex items-center justify-center hover:bg-slate-200 dark:hover:bg-white/20 transition-colors">
                                                <!-- X Logo (formerly Twitter) -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-700 dark:text-white" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Footer -->
                <footer class="relative py-12 px-6 border-t border-slate-200/20 dark:border-white/10">
                    <div class="max-w-7xl mx-auto">
                        <div class="flex flex-col md:flex-row justify-between items-center">
                            <div class="mb-6 md:mb-0">
                                <img src="{{ asset('images/ms-logo-black-text-vertical.svg') }}" alt="MotionStack Design" class="h-16 dark:hidden">
                                <img src="{{ asset('images/ms-logo-white-text-vertical.svg') }}" alt="MotionStack Design" class="h-16 hidden dark:block">
                                <p class="text-slate-600 dark:text-zinc-400 mt-2">Bringing brands to life through motion.</p>
                            </div>
                            <div class="text-slate-600 dark:text-zinc-400 text-sm">
                                &copy; {{ date('Y') }} MotionStack Design. All rights reserved.
                            </div>
                        </div>
                    </div>
                </footer>
            </main>
        </div>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>
