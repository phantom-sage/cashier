<div>
    <!-- Mobile menu button -->
    <div class="md:hidden">
        <button type="button" 
                wire:click="toggleMenu"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 transition-colors duration-200"
                aria-label="{{ $isOpen ? __('Close menu') : __('Open menu') }}">
            @if($isOpen)
                <!-- X icon when menu is open -->
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            @else
                <!-- Hamburger icon when menu is closed -->
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            @endif
        </button>
    </div>

    <!-- Mobile menu overlay and panel -->
    @if($isOpen)
        <!-- Backdrop -->
        <div class="fixed inset-0 z-40 bg-black bg-opacity-25 md:hidden" wire:click="closeMenu"></div>
        
        <!-- Mobile menu panel -->
        <div class="fixed top-0 {{ app()->getLocale() === 'ar' ? 'left-0' : 'right-0' }} z-50 w-full max-w-sm h-full bg-white dark:bg-gray-800 shadow-xl md:hidden">
            
            <!-- Mobile menu header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center {{ app()->getLocale() === 'ar' ? 'space-x-reverse space-x-2' : 'space-x-2' }}">
                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900 dark:text-white">ProductHub</span>
                </div>
                
                <button type="button" 
                        wire:click="closeMenu"
                        class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile menu content -->
            <div class="flex flex-col h-full">
                <!-- Navigation Links -->
                <nav class="flex-1 px-4 py-6 space-y-2">
                    <a href="{{ route('dashboard') }}" 
                       wire:click="closeMenu"
                       class="flex items-center px-3 py-3 text-base font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'text-blue-600 bg-blue-50 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:text-blue-600 hover:bg-gray-50 dark:hover:bg-gray-700 dark:hover:text-blue-400' }}">
                        <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                        </svg>
                        {{ __('app.dashboard') }}
                    </a>

                    <a href="{{ route('products.index') }}" 
                       wire:click="closeMenu"
                       class="flex items-center px-3 py-3 text-base font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('products.*') ? 'text-blue-600 bg-blue-50 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300 hover:text-blue-600 hover:bg-gray-50 dark:hover:bg-gray-700 dark:hover:text-blue-400' }}">
                        <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        {{ __('app.products') }}
                    </a>

                    <a href="{{ route('orders.create') }}" 
                       wire:click="closeMenu"
                       class="flex items-center px-3 py-3 text-base font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('orders.create') ? 'text-green-600 bg-green-50 dark:bg-green-900/20 dark:text-green-400' : 'text-gray-700 dark:text-gray-300 hover:text-green-600 hover:bg-gray-50 dark:hover:bg-gray-700 dark:hover:text-green-400' }}">
                        <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        {{ __('app.cashier') }}
                    </a>

                    <a href="{{ route('orders.index') }}" 
                       wire:click="closeMenu"
                       class="flex items-center px-3 py-3 text-base font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('orders.index') || request()->routeIs('orders.receipt') ? 'text-purple-600 bg-purple-50 dark:bg-purple-900/20 dark:text-purple-400' : 'text-gray-700 dark:text-gray-300 hover:text-purple-600 hover:bg-gray-50 dark:hover:bg-gray-700 dark:hover:text-purple-400' }}">
                        <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        {{ __('app.orders') }}
                    </a>
                </nav>

                <!-- Mobile Search -->
                <div class="px-4 py-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="relative">
                        <div class="absolute inset-y-0 {{ app()->getLocale() === 'ar' ? 'right-0 pr-3' : 'left-0 pl-3' }} flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" placeholder="{{ __('app.search_products') }}" 
                               class="block w-full {{ app()->getLocale() === 'ar' ? 'pr-10 pl-3' : 'pl-10 pr-3' }} py-3 border border-gray-300 dark:border-gray-600 rounded-lg leading-5 bg-white dark:bg-gray-700 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm dark:text-white">
                    </div>
                </div>

                <!-- Mobile User Section -->
                <div class="px-4 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                    <div class="flex items-center {{ app()->getLocale() === 'ar' ? 'space-x-reverse space-x-3' : 'space-x-3' }} mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white font-medium">
                            {{ auth()->user()->initials() }}
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        <a href="{{ route('profile.edit') }}" 
                           wire:click="closeMenu"
                           class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                            <svg class="w-4 h-4 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{ __('app.profile') }}
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="flex items-center w-full px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                                <svg class="w-4 h-4 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                {{ __('app.logout') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>