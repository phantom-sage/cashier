<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-8">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-green-600 to-blue-700 rounded-2xl p-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">{{ __('app.cashier_system') }}</h1>
                        <p class="text-green-100 text-lg">{{ __('Create new orders and manage sales') }}</p>
                    </div>
                    <div class="mt-6 lg:mt-0 flex space-x-4">
                        <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold">{{ $this->getTotalItems() }}</div>
                            <div class="text-green-100 text-sm">{{ __('app.items_in_cart') }}</div>
                        </div>
                        <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold">{{ $this->getFormattedTotal() }}</div>
                            <div class="text-green-100 text-sm">{{ __('app.total_amount') }}</div>
                        </div>
                    </div>
                </div>
            </div>

    <!-- Success/Error Messages -->
    @if (session()->has('message'))
        <div class="bg-green-50 dark:bg-green-900/20 border-l-4 border-green-400 p-4 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700 dark:text-green-300 font-medium">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-50 dark:bg-red-900/20 border-l-4 border-red-400 p-4 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-700 dark:text-red-300 font-medium">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
        <!-- Products Section -->
        <div class="space-y-6">
            <!-- Search Section -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input 
                        wire:model.live.debounce.300ms="search" 
                        type="text" 
                        placeholder="{{ __('app.search_products') }}" 
                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-xl leading-5 bg-white dark:bg-gray-800 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:border-transparent sm:text-sm text-gray-900 dark:text-white shadow-sm"
                    />
                    
                    <!-- Loading Indicator -->
                    <div wire:loading wire:target="search" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <svg class="animate-spin h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="relative">
                <!-- Loading Overlay -->
                <div wire:loading.delay wire:target="search" class="absolute inset-0 bg-white/75 dark:bg-gray-900/75 backdrop-blur-sm rounded-2xl z-10 flex items-center justify-center">
                    <div class="flex items-center space-x-2 text-green-600">
                        <svg class="animate-spin h-6 w-6" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="text-sm font-medium">{{ __('app.searching') }}</span>
                    </div>
                </div>

                @if($products->count() > 0)
                    <!-- Responsive Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-4">
                        @foreach($products as $product)
                            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-200 dark:border-gray-700 hover:border-green-300 dark:hover:border-green-600">
                                <!-- Product Image -->
                                <div class="aspect-square bg-gray-100 dark:bg-gray-700 overflow-hidden relative">
                                    @if($product->image)
                                        <img 
                                            src="{{ asset($product->image) }}" 
                                            alt="{{ $product->name }}"
                                            class="w-full h-full object-cover"
                                            loading="lazy"
                                        >
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <!-- Price Badge -->
                                    <div class="absolute top-2 right-2">
                                        <span class="bg-green-600 text-white px-2 py-1 rounded-full text-xs font-semibold shadow-lg">
                                            {{ $product->formatted_price }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Product Info -->
                                <div class="p-4">
                                    <!-- Product Name -->
                                    <h3 class="font-semibold text-sm text-gray-900 dark:text-white mb-2 truncate">
                                        {{ $product->name }}
                                    </h3>

                                    <!-- Add to Cart Button -->
                                    <button 
                                        wire:click="addToCart({{ $product->id }})"
                                        class="w-full inline-flex items-center justify-center px-3 py-2 bg-gradient-to-r from-green-500 to-blue-600 text-sm font-medium rounded-lg hover:from-green-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 shadow-md hover:shadow-lg"
                                    >
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        {{ __('app.add_to_cart') }}
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $products->links() }}
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-8">
                            <div class="w-16 h-16 bg-gradient-to-br from-green-100 to-blue-100 dark:from-green-900/20 dark:to-blue-900/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            
                            @if($search)
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ __('app.no_products_found') }}</h3>
                                <p class="text-gray-500 dark:text-gray-400 mb-4">
                                    {{ __('app.no_products_match') }} "<strong>{{ $search }}</strong>". {{ __('app.try_different_search') }}
                                </p>
                                <button 
                                    wire:click="$set('search', '')"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200"
                                >
                                    {{ __('app.clear_search') }}
                                </button>
                            @else
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ __('app.no_products') }}</h3>
                                <p class="text-gray-500 dark:text-gray-400">
                                    {{ __('Add some products to start creating orders.') }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Cart Section -->
        <div class="space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 sticky top-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('app.cart') }}</h2>
                    @if(!empty($cart))
                        <button 
                            wire:click="clearCart"
                            class="text-sm text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 font-medium"
                        >
                            {{ __('app.clear_cart') }}
                        </button>
                    @endif
                </div>

                @if(empty($cart))
                    <!-- Empty Cart -->
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8m-8 0a2 2 0 100 4 2 2 0 000-4zm8 0a2 2 0 100 4 2 2 0 000-4z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">{{ __('app.cart_empty') }}</p>
                        <p class="text-gray-400 dark:text-gray-500 text-xs mt-1">{{ __('app.add_products_to_start') }}</p>
                    </div>
                @else
                    <!-- Cart Items -->
                    <div class="space-y-4 mb-6 max-h-96 overflow-y-auto">
                        @foreach($cart as $productId => $item)
                            <div class="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                <!-- Product Image -->
                                <div class="w-12 h-12 bg-gray-200 dark:bg-gray-600 rounded-lg overflow-hidden flex-shrink-0">
                                    @if($item['product']->image)
                                        <img src="{{ asset($item['product']->image) }}" alt="{{ $item['product']->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Product Info -->
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $item['product']->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">${{ number_format($item['unit_price'], 2) }} {{ __('app.each') }}</p>
                                </div>

                                <!-- Quantity Controls -->
                                <div class="flex items-center space-x-2">
                                    <button 
                                        wire:click="decrementQuantity({{ $productId }})"
                                        type="button"
                                        class="w-6 h-6 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center hover:bg-gray-300 dark:hover:bg-gray-500 transition-colors"
                                    >
                                        <svg class="w-3 h-3 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                        </svg>
                                    </button>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white w-6 text-center">{{ $item['quantity'] }}</span>
                                    <button 
                                        wire:click="incrementQuantity({{ $productId }})"
                                        type="button"
                                        class="w-6 h-6 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center hover:bg-gray-300 dark:hover:bg-gray-500 transition-colors"
                                    >
                                        <svg class="w-3 h-3 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Remove Button -->
                                <button 
                                    wire:click="removeFromCart({{ $productId }})"
                                    class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <!-- Cart Summary -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600 dark:text-gray-400">{{ __('app.items') }} ({{ $this->getTotalItems() }})</span>
                            <span class="text-gray-900 dark:text-white font-medium">{{ $this->getFormattedTotal() }}</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold">
                            <span class="text-gray-900 dark:text-white">{{ __('app.total') }}</span>
                            <span class="text-green-600 dark:text-green-400">{{ $this->getFormattedTotal() }}</span>
                        </div>
                    </div>

                    <!-- Checkout Button -->
                    <button 
                        wire:click="checkout"
                        class="w-full mt-6 inline-flex items-center justify-center px-4 py-3 border border-transparent text-base font-medium rounded-xl bg-gradient-to-r from-green-500 to-blue-600 hover:from-green-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 shadow-lg hover:shadow-xl"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        {{ __('app.checkout') }}
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
</div>