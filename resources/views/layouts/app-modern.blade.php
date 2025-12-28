<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    @if(app()->getLocale() === 'ar')
        <!-- Arabic Font -->
        <link href="https://fonts.bunny.net/css?family=noto-sans-arabic:400,500,600,700&display=swap" rel="stylesheet" />
    @else
        <!-- English Font -->
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @endif

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Theme Initialization Script -->
    <script>
        // Initialize theme before page renders to prevent flash
        (function() {
            const darkMode = localStorage.getItem('darkMode') === 'true' || 
                           (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches);
            if (darkMode) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 {{ app()->getLocale() === 'ar' ? 'font-arabic' : '' }}">
    <!-- Top Navigation -->
    <nav class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Left side (Navigation + Logo in RTL) -->
                @if(app()->getLocale() === 'ar')
                    <!-- RTL: Navigation Links first, then Logo -->
                    <div class="flex items-center">
                        <!-- Navigation Links -->
                        <div class="hidden md:flex md:space-x-reverse md:space-x-8">
                            <a href="{{ route('dashboard') }}" 
                               class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }}">
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                                </svg>
                                {{ __('app.dashboard') }}
                            </a>
                            <a href="{{ route('products.index') }}" 
                               class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('products.*') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }}">
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                {{ __('app.products') }}
                            </a>
                            <a href="{{ route('orders.create') }}" 
                               class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('orders.create') ? 'text-green-600 border-b-2 border-green-600' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }}">
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                {{ __('app.cashier') }}
                            </a>
                            <a href="{{ route('orders.index') }}" 
                               class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('orders.index') || request()->routeIs('orders.receipt') ? 'text-purple-600 border-b-2 border-purple-600' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }}">
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                </svg>
                                {{ __('app.orders') }}
                            </a>
                        </div>
                        
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center mr-10">
                            <a href="{{ route('dashboard') }}" class="flex items-center space-x-reverse space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <span class="text-xl font-bold text-gray-900 dark:text-white">ProductHub</span>
                            </a>
                        </div>
                    </div>
                @else
                    <!-- LTR: Logo first, then Navigation Links -->
                    <div class="flex items-center">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <span class="text-xl font-bold text-gray-900 dark:text-white">ProductHub</span>
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden md:ml-10 md:flex md:space-x-8">
                            <a href="{{ route('dashboard') }}" 
                               class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                                </svg>
                                {{ __('app.dashboard') }}
                            </a>
                            <a href="{{ route('products.index') }}" 
                               class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('products.*') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                {{ __('app.products') }}
                            </a>
                            <a href="{{ route('orders.create') }}" 
                               class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('orders.create') ? 'text-green-600 border-b-2 border-green-600' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                {{ __('app.cashier') }}
                            </a>
                            <a href="{{ route('orders.index') }}" 
                               class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('orders.index') || request()->routeIs('orders.receipt') ? 'text-purple-600 border-b-2 border-purple-600' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                </svg>
                                {{ __('app.orders') }}
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Right side -->
                <div class="flex items-center {{ app()->getLocale() === 'ar' ? 'space-x-reverse space-x-4' : 'space-x-4' }}">
                    <!-- Language Switcher -->
                    <livewire:components.language-switcher />
                    
                    <!-- Theme Toggle -->
                    <livewire:components.theme-toggle />

                    <!-- Search -->
                    <div class="hidden md:block">
                        <div class="relative">
                            <div class="absolute inset-y-0 {{ app()->getLocale() === 'ar' ? 'right-0 pr-3' : 'left-0 pl-3' }} flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" placeholder="{{ __('app.search_products') }}" 
                                   class="block w-full {{ app()->getLocale() === 'ar' ? 'pr-10 pl-3' : 'pl-10 pr-3' }} py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        </div>
                    </div>

                    <!-- Add Product Button -->
                    <a href="{{ route('orders.create') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-green-500 to-blue-600 hover:from-green-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                        <svg class="w-4 h-4 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        {{ __('app.cashier') }}
                    </a>

                    <!-- User Menu -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                                class="flex items-center {{ app()->getLocale() === 'ar' ? 'space-x-reverse space-x-3' : 'space-x-3' }} text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white font-medium">
                                {{ auth()->user()->initials() }}
                            </div>
                            <span class="hidden md:block text-gray-700 dark:text-gray-300 font-medium">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4 text-gray-400 {{ app()->getLocale() === 'ar' ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition
                             class="absolute {{ app()->getLocale() === 'ar' ? 'left-0' : 'right-0' }} mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50 border border-gray-200 dark:border-gray-700">
                            <a href="{{ route('profile.edit') }}" 
                               class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-4 h-4 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ __('app.profile') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="block w-full text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <svg class="w-4 h-4 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    {{ __('app.logout') }}
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <button type="button" x-data="{ open: false }" @click="open = !open"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="min-h-screen">
        @hasSection('content')
            @yield('content')
        @else
            {{ $slot }}
        @endif
    </main>

    @stack('modals')
    @livewireScripts
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>