<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<style>
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
    <body x-data="{darkMode: true}" :class="darkMode ? 'dark' : ''" class="font-raleway bg-zinc-50 dark:bg-[#04041F] text-slate-900 dark:text-white flex p-0 items-center justify-center min-h-screen flex-col antialiased selection:bg-purple-500/10 dark:selection:bg-blue-500/10 overflow-x-hidden">
        <!-- Navigation -->
        <header class="fixed top-0 w-full z-50 transition-all duration-300 backdrop-blur-sm bg-white/10 dark:bg-[#04041F]/80 border-b border-transparent" 
               x-data="{isScrolled: false}"
               x-init="window.addEventListener('scroll', () => { isScrolled = window.scrollY > 20 })"
               :class="{'border-white/10 shadow-lg': isScrolled}">
            <div class="container mx-auto px-6 py-4">
                <nav class="flex items-center justify-between">
                    <!-- Logo -->
                    <a href="#" class="flex items-center space-x-2">
                        <img src="/images/ms-logo-white-text.svg" alt="MotionStack Design" class="h-10 hidden dark:block">
                        <img src="/images/ms-logo-black-text.svg" alt="MotionStack Design" class="h-10 block dark:hidden">
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
                        <button @click="darkMode = !darkMode" class="p-2 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-white/80 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                        </button>
                        <a href="#contact" class="hidden md:block px-5 py-2 bg-gradient-to-r from-purple-600 to-blue-500 hover:from-purple-700 hover:to-blue-600 text-white rounded-md font-medium transition-all duration-300 transform hover:scale-105">
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
                        <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full bg-purple-600/30 blur-3xl"></div>
                        <div class="absolute top-40 -left-40 w-96 h-96 rounded-full bg-blue-600/30 blur-3xl"></div>
                        <div class="absolute bottom-0 left-1/2 w-full h-1/2 bg-gradient-to-t from-[#04041F]/80 to-transparent"></div>
                    </div>
                    
                    <!-- Hero Content -->
                    <div class="relative z-10 max-w-7xl mx-auto w-full">
                        <div class="flex flex-col lg:flex-row items-center gap-12">
                            <div class="lg:w-1/2">
                                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-purple-600">
                                    Motion Design <span class="block">Reimagined</span>
                                </h1>
                                <p class="text-lg md:text-xl max-w-2xl mb-10 text-zinc-300">
                                    Elevate your digital presence with captivating motion design that brings your brand to life. We create stunning animations that engage and inspire.                            
                                </p>
                                <div class="flex flex-col sm:flex-row gap-4">
                                    <a href="#services" class="px-8 py-3 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium transition-transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-[#04041F]">
                                        Explore Services
                                    </a>
                                    <a href="#portfolio" class="px-8 py-3 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white font-medium transition-all hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white/20 focus:ring-offset-2 focus:ring-offset-[#04041F]">
                                        View Portfolio
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Animated Preview -->
                            <div class="lg:w-1/2 relative">
                                <div class="relative mx-auto max-w-md overflow-hidden rounded-xl bg-white/5 backdrop-blur-sm border border-white/10 shadow-2xl">
                                    <div class="p-1 bg-gradient-to-r from-blue-500 to-purple-600"></div>
                                    <div class="p-6 md:p-8">
                                        <div class="flex justify-between items-center mb-6">
                                            <div class="flex space-x-2">
                                                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                            </div>
                                            <div class="text-sm text-zinc-400">motionstack.design</div>
                                        </div>
                                        <div class="aspect-video bg-zinc-800 rounded-lg flex items-center justify-center">
                                            <p class="text-zinc-400">Animation Preview</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Floating Elements -->
                                <div class="absolute -top-10 -left-10 w-20 h-20 bg-blue-500/10 backdrop-blur-md rounded-full border border-blue-500/20 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                                    </svg>
                                </div>
                                <div class="absolute -bottom-10 -right-10 w-20 h-20 bg-purple-500/10 backdrop-blur-md rounded-full border border-purple-500/20 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Services Section -->
                <section id="services" class="relative py-20 px-6 overflow-hidden">
                    <!-- Background Gradients -->
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="absolute top-40 right-20 w-72 h-72 rounded-full bg-blue-600/20 blur-3xl"></div>
                        <div class="absolute -bottom-20 -left-20 w-72 h-72 rounded-full bg-purple-600/20 blur-3xl"></div>
                    </div>
                    
                    <div class="relative z-10 max-w-7xl mx-auto">
                        <!-- Section Header -->
                        <div class="text-center mb-16">
                            <h2 class="text-3xl md:text-4xl font-bold mb-4">Our <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-purple-600">Services</span></h2>
                            <p class="text-lg text-zinc-400 max-w-2xl mx-auto">We offer a comprehensive range of motion design services to elevate your brand and captivate your audience.</p>
                        </div>
                        
                        <!-- Services Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            <!-- Service Card 1 -->
                            <div class="group relative bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10">
                                <div class="animated-border">
                                    <div class="border-line border-line-top"></div>
                                    <div class="border-line border-line-right"></div>
                                    <div class="border-line border-line-bottom"></div>
                                    <div class="border-line border-line-left"></div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-purple-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative z-10 p-1 bg-gradient-to-r from-blue-500/80 to-purple-600/80"></div>
                                <div class="p-6 relative z-10">
                                    <div class="w-12 h-12 rounded-lg bg-white/10 flex items-center justify-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold mb-2">UI/UX Animation</h3>
                                    <p class="text-zinc-400 mb-4">Enhance user experience with smooth, intuitive interface animations that guide users and add delight to interactions.</p>
                                    <a href="#" class="inline-flex items-center text-blue-400 hover:text-blue-300 transition-colors">
                                        Learn more
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Service Card 2 -->
                            <div class="group relative bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10">
                                <div class="animated-border animated-border-purple">
                                    <div class="border-line border-line-top border-line-purple"></div>
                                    <div class="border-line border-line-right border-line-purple"></div>
                                    <div class="border-line border-line-bottom border-line-purple"></div>
                                    <div class="border-line border-line-left border-line-purple"></div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-purple-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative z-10 p-1 bg-gradient-to-r from-blue-500/80 to-purple-600/80"></div>
                                <div class="p-6 relative z-10">
                                    <div class="w-12 h-12 rounded-lg bg-white/10 flex items-center justify-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold mb-2">Explainer Videos</h3>
                                    <p class="text-zinc-400 mb-4">Communicate complex ideas simply and effectively with engaging animated explainer videos tailored to your brand.</p>
                                    <a href="#" class="inline-flex items-center text-purple-400 hover:text-purple-300 transition-colors">
                                        Learn more
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Service Card 3 -->
                            <div class="group relative bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10">
                                <div class="animated-border">
                                    <div class="border-line border-line-top"></div>
                                    <div class="border-line border-line-right"></div>
                                    <div class="border-line border-line-bottom"></div>
                                    <div class="border-line border-line-left"></div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-purple-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative z-10 p-1 bg-gradient-to-r from-blue-500/80 to-purple-600/80"></div>
                                <div class="p-6 relative z-10">
                                    <div class="w-12 h-12 rounded-lg bg-white/10 flex items-center justify-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold mb-2">Logo Animation</h3>
                                    <p class="text-zinc-400 mb-4">Bring your brand identity to life with dynamic logo animations that leave a lasting impression on your audience.</p>
                                    <a href="#" class="inline-flex items-center text-blue-400 hover:text-blue-300 transition-colors">
                                        Learn more
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Service Card 4 -->
                            <div class="group relative bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10">
                                <div class="animated-border animated-border-purple">
                                    <div class="border-line border-line-top border-line-purple"></div>
                                    <div class="border-line border-line-right border-line-purple"></div>
                                    <div class="border-line border-line-bottom border-line-purple"></div>
                                    <div class="border-line border-line-left border-line-purple"></div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-purple-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative z-10 p-1 bg-gradient-to-r from-blue-500/80 to-purple-600/80"></div>
                                <div class="p-6 relative z-10">
                                    <div class="w-12 h-12 rounded-lg bg-white/10 flex items-center justify-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold mb-2">Social Media Content</h3>
                                    <p class="text-zinc-400 mb-4">Stand out in crowded feeds with eye-catching animated content optimized for social media platforms.</p>
                                    <a href="#" class="inline-flex items-center text-purple-400 hover:text-purple-300 transition-colors">
                                        Learn more
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Service Card 5 -->
                            <div class="group relative bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10">
                                <div class="animated-border">
                                    <div class="border-line border-line-top"></div>
                                    <div class="border-line border-line-right"></div>
                                    <div class="border-line border-line-bottom"></div>
                                    <div class="border-line border-line-left"></div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-purple-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative z-10 p-1 bg-gradient-to-r from-blue-500/80 to-purple-600/80"></div>
                                <div class="p-6 relative z-10">
                                    <div class="w-12 h-12 rounded-lg bg-white/10 flex items-center justify-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold mb-2">Character Animation</h3>
                                    <p class="text-zinc-400 mb-4">Create memorable characters that resonate with your audience and bring personality to your brand storytelling.</p>
                                    <a href="#" class="inline-flex items-center text-blue-400 hover:text-blue-300 transition-colors">
                                        Learn more
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Service Card 6 -->
                            <div class="group relative bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10">
                                <div class="animated-border animated-border-purple">
                                    <div class="border-line border-line-top border-line-purple"></div>
                                    <div class="border-line border-line-right border-line-purple"></div>
                                    <div class="border-line border-line-bottom border-line-purple"></div>
                                    <div class="border-line border-line-left border-line-purple"></div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-purple-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="relative z-10 p-1 bg-gradient-to-r from-blue-500/80 to-purple-600/80"></div>
                                <div class="p-6 relative z-10">
                                    <div class="w-12 h-12 rounded-lg bg-white/10 flex items-center justify-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold mb-2">Motion Graphics</h3>
                                    <p class="text-zinc-400 mb-4">Transform static designs into dynamic visual experiences with professional motion graphics for any medium.</p>
                                    <a href="#" class="inline-flex items-center text-purple-400 hover:text-purple-300 transition-colors">
                                        Learn more
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- CTA Button -->
                        <div class="mt-12 text-center">
                            <a href="#contact" class="inline-block px-8 py-3 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium transition-transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-[#04041F]">
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
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
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
                                <h2 class="text-3xl md:text-4xl font-bold mb-6">Why Choose <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-purple-600">MotionStack</span></h2>
                                <p class="text-lg text-zinc-400 mb-8">We combine technical expertise with creative vision to deliver motion design that captivates audiences and drives results.</p>
                                
                                <!-- Features List -->
                                <div class="space-y-6">
                                    <!-- Feature 1 -->
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center mr-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                            <p class="text-lg text-zinc-400 max-w-2xl mx-auto">Explore our latest motion design projects and see how we bring brands to life through animation.</p>
                        </div>
                        
                        <!-- Portfolio Filter -->
                        <div class="flex flex-wrap justify-center gap-2 mb-12">
                            <button class="px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white font-medium transition-all hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white/20 focus:ring-offset-2 focus:ring-offset-[#04041F] active">
                                All Projects
                            </button>
                            <button class="px-4 py-2 rounded-full bg-transparent border border-white/10 text-zinc-400 font-medium transition-all hover:bg-white/5 hover:text-white focus:outline-none focus:ring-2 focus:ring-white/20 focus:ring-offset-2 focus:ring-offset-[#04041F]">
                                UI Animation
                            </button>
                            <button class="px-4 py-2 rounded-full bg-transparent border border-white/10 text-zinc-400 font-medium transition-all hover:bg-white/5 hover:text-white focus:outline-none focus:ring-2 focus:ring-white/20 focus:ring-offset-2 focus:ring-offset-[#04041F]">
                                Explainer Videos
                            </button>
                            <button class="px-4 py-2 rounded-full bg-transparent border border-white/10 text-zinc-400 font-medium transition-all hover:bg-white/5 hover:text-white focus:outline-none focus:ring-2 focus:ring-white/20 focus:ring-offset-2 focus:ring-offset-[#04041F]">
                                Logo Animation
                            </button>
                        </div>
                        
                        <!-- Portfolio Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
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
                                        <p class="text-zinc-300 mb-4">UI/UX Animation</p>
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
                            <a href="#" class="inline-block px-8 py-3 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white font-medium transition-all hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white/20 focus:ring-offset-2 focus:ring-offset-[#04041F]">
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
                            <p class="text-lg text-zinc-400 max-w-2xl mx-auto">Don't just take our word for it. Here's what our clients have to say about working with MotionStack.</p>
                        </div>
                        
                        <!-- Testimonials Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            <!-- Testimonial 1 -->
                            <div class="group relative bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10 p-8">
                                <div class="animated-border">
                                    <div class="border-line border-line-top"></div>
                                    <div class="border-line border-line-right"></div>
                                    <div class="border-line border-line-bottom"></div>
                                    <div class="border-line border-line-left"></div>
                                </div>
                                <div class="absolute top-4 left-4 text-4xl text-blue-500/20">"</div>
                                <div class="relative">
                                    <p class="text-zinc-300 mb-6">Wow what an Amazing experience I had with motion stack he knew exactly what I wanted and what we as a group needed. Thanx man I would recommend to everyone.</p>
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center mr-4">
                                            <span class="text-white font-bold">JF</span>
                                        </div>
                                        <div>
                                            <h4 class="font-bold">Julio Fitzpatrick</h4>
                                            <p class="text-sm text-zinc-400">September 1, 2023</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Testimonial 2 -->
                            <div class="group relative bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10 p-8">
                                <div class="animated-border animated-border-purple">
                                    <div class="border-line border-line-top border-line-purple"></div>
                                    <div class="border-line border-line-right border-line-purple"></div>
                                    <div class="border-line border-line-bottom border-line-purple"></div>
                                    <div class="border-line border-line-left border-line-purple"></div>
                                </div>
                                <div class="absolute top-4 left-4 text-4xl text-purple-500/20">"</div>
                                <div class="relative">
                                    <p class="text-zinc-300 mb-6">Jacques has been exceptionally professional and creative. I do not know anything about web design and Jacques educated me on the different templates and look & feels of a website. He has dealt very calmly with me, over a period of a month back and forth, after I have given him more than 20 different changes that led to the final design of my website.</p>
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-600 to-blue-500 flex items-center justify-center mr-4">
                                            <span class="text-white font-bold">FR</span>
                                        </div>
                                        <div>
                                            <h4 class="font-bold">Francois Rademeyer</h4>
                                            <p class="text-sm text-zinc-400">Owner @ Minus 1 Recruitment</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Testimonial 3 -->
                            <div class="group relative bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10 p-8">
                                <div class="animated-border">
                                    <div class="border-line border-line-top"></div>
                                    <div class="border-line border-line-right"></div>
                                    <div class="border-line border-line-bottom"></div>
                                    <div class="border-line border-line-left"></div>
                                </div>
                                <div class="absolute top-4 left-4 text-4xl text-blue-500/20">"</div>
                                <div class="relative">
                                    <p class="text-zinc-300 mb-6">Jacques rendered excellent, professional service. He explained the process to get our website up and running step by step and the end-result surpassed our expectations. Thank you for making this process less daunting for us as a start-up business.</p>
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center mr-4">
                                            <span class="text-white font-bold">DD</span>
                                        </div>
                                        <div>
                                            <h4 class="font-bold">Dust & Daisies Guided Tours</h4>
                                            <p class="text-sm text-zinc-400">July 30, 2022</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Testimonial 4 -->
                            <div class="group relative bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10 p-8">
                                <div class="animated-border animated-border-purple">
                                    <div class="border-line border-line-top border-line-purple"></div>
                                    <div class="border-line border-line-right border-line-purple"></div>
                                    <div class="border-line border-line-bottom border-line-purple"></div>
                                    <div class="border-line border-line-left border-line-purple"></div>
                                </div>
                                <div class="absolute top-4 left-4 text-4xl text-purple-500/20">"</div>
                                <div class="relative">
                                    <p class="text-zinc-300 mb-6">Always friendly and helpful, good customer service.</p>
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-600 to-blue-500 flex items-center justify-center mr-4">
                                            <span class="text-white font-bold">JH</span>
                                        </div>
                                        <div>
                                            <h4 class="font-bold">Jennepher Hammond</h4>
                                            <p class="text-sm text-zinc-400">July 22, 2022</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Testimonial 5 -->
                            <div class="group relative bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10 p-8">
                                <div class="animated-border">
                                    <div class="border-line border-line-top"></div>
                                    <div class="border-line border-line-right"></div>
                                    <div class="border-line border-line-bottom"></div>
                                    <div class="border-line border-line-left"></div>
                                </div>
                                <div class="absolute top-4 left-4 text-4xl text-blue-500/20">"</div>
                                <div class="relative">
                                    <p class="text-zinc-300 mb-6">I have worked with Jacq for few years. He helped me with my website, YouTube channels, telegram channel, video editing, making intro and outro for video series and other things. I have found him reliable, trustworthy, creative and very helpful.</p>
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center mr-4">
                                            <span class="text-white font-bold">IA</span>
                                        </div>
                                        <div>
                                            <h4 class="font-bold">Imad Awde</h4>
                                            <p class="text-sm text-zinc-400">July 22, 2022</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Testimonial 6 -->
                            <div class="group relative bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl overflow-hidden transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:shadow-purple-500/10 p-8">
                                <div class="animated-border animated-border-purple">
                                    <div class="border-line border-line-top border-line-purple"></div>
                                    <div class="border-line border-line-right border-line-purple"></div>
                                    <div class="border-line border-line-bottom border-line-purple"></div>
                                    <div class="border-line border-line-left border-line-purple"></div>
                                </div>
                                <div class="absolute top-4 left-4 text-4xl text-purple-500/20">"</div>
                                <div class="relative">
                                    <p class="text-zinc-300 mb-6">Always a pleasure to working with them. Great customer service. I would definitely recommend Motionstack!</p>
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-600 to-blue-500 flex items-center justify-center mr-4">
                                            <span class="text-white font-bold">WS</span>
                                        </div>
                                        <div>
                                            <h4 class="font-bold">Wendy Scheffers</h4>
                                            <p class="text-sm text-zinc-400">July 19, 2022</p>
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
                                <h2 class="text-3xl md:text-4xl font-bold mb-4">Get in <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-purple-600">Touch</span></h2>
                                <p class="text-lg text-zinc-400 mb-8">Ready to bring your ideas to life? Fill out the form below and we'll get back to you within 24 hours.</p>
                                
                                <!-- Contact Form -->
                                <form class="space-y-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="name" class="block text-sm font-medium text-zinc-300 mb-2">Name</label>
                                            <input type="text" id="name" name="name" class="w-full px-4 py-3 rounded-lg bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="Your name">
                                        </div>
                                        <div>
                                            <label for="email" class="block text-sm font-medium text-zinc-300 mb-2">Email</label>
                                            <input type="email" id="email" name="email" class="w-full px-4 py-3 rounded-lg bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="your@email.com">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="subject" class="block text-sm font-medium text-zinc-300 mb-2">Subject</label>
                                        <input type="text" id="subject" name="subject" class="w-full px-4 py-3 rounded-lg bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="Project inquiry">
                                    </div>
                                    <div>
                                        <label for="message" class="block text-sm font-medium text-zinc-300 mb-2">Message</label>
                                        <textarea id="message" name="message" rows="5" class="w-full px-4 py-3 rounded-lg bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="Tell us about your project..."></textarea>
                                    </div>
                                    <div>
                                        <button type="submit" class="px-8 py-3 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium transition-transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-[#04041F]">
                                            Send Message
                                        </button>
                                    </div>
                                </form>
                            </div>
                            
                            <!-- Right Column: Contact Info -->
                            <div class="lg:w-1/3">
                                <div class="group relative bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl overflow-hidden p-8">
                                    <div class="border-flow-animation"></div>
                                    <div class="border-gradient border-gradient-purple"></div>
                                    <h3 class="text-xl font-bold mb-6">Contact Information</h3>
                                    
                                    <div class="space-y-6">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center mr-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-medium mb-1">Phone</h4>
                                                <p class="text-zinc-400">+27 (0)79 470-3941</p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center mr-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-medium mb-1">Email</h4>
                                                <p class="text-zinc-400">info@motionstack.design</p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center mr-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-medium mb-1">Location</h4>
                                                <p class="text-zinc-400">South Africa</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-8">
                                        <h4 class="font-medium mb-4">Follow Us</h4>
                                        <div class="flex space-x-4">
                                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors">
                                                <!-- X Logo (formerly Twitter) -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
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
                <footer class="relative py-12 px-6 border-t border-white/10">
                    <div class="max-w-7xl mx-auto">
                        <div class="flex flex-col md:flex-row justify-between items-center">
                            <div class="mb-6 md:mb-0">
                                <img src="/images/ms-logo-white-text.svg" alt="MotionStack Design" class="h-8">
                                <p class="text-zinc-400 mt-2">Bringing brands to life through motion.</p>
                            </div>
                            <div class="text-zinc-400 text-sm">
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
