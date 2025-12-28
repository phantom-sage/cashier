<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-8">
            <!-- Header Section -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 print:shadow-none print:border-none">
                <div class="flex items-center justify-between print:block">
                    <div class="flex items-center space-x-4 print:text-center print:space-x-0">
                        <a href="{{ route('orders.create') }}" 
                           class="inline-flex items-center text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 print:hidden">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Cashier
                        </a>
                    </div>
                    
                    <div class="flex space-x-3 print:hidden print:mt-4 print:justify-center">
                        <button 
                            onclick="window.print()"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                            </svg>
                            Print Receipt
                        </button>
                        
                        <a href="{{ route('orders.create') }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg bg-gradient-to-r from-green-500 to-blue-600 hover:from-green-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 shadow-lg hover:shadow-xl">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            New Order
                        </a>
                    </div>
                </div>
                <div class="mt-4 print:mt-0">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white print:text-2xl print:text-center">Order Receipt</h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-2 print:text-center print:text-sm">Order completed successfully</p>
                </div>
            </div>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="bg-green-50 dark:bg-green-900/20 border-l-4 border-green-400 p-4 rounded-lg print:hidden">
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

    <!-- Receipt Content -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden print:shadow-none print:border-none print:rounded-none">
        <!-- Receipt Header -->
        <div class="bg-gradient-to-r from-green-50 to-blue-50 dark:from-green-900/20 dark:to-blue-900/20 p-8 print:bg-white print:p-4">
            <div class="text-center">
                <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 print:w-12 print:h-12 print:mb-2">
                    <svg class="w-8 h-8 text-white print:w-6 print:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white print:text-lg">{{ config('app.name', 'ProductHub') }}</h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1 print:text-sm">Thank you for your purchase!</p>
            </div>
        </div>

        <!-- Order Details -->
        <div class="p-8 print:p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8 print:grid-cols-2 print:gap-4 print:mb-4">
                <!-- Order Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 print:text-base print:mb-2">Order Information</h3>
                    <dl class="space-y-2 print:space-y-1">
                        <div class="flex justify-between print:text-sm">
                            <dt class="text-gray-600 dark:text-gray-400">Order Number:</dt>
                            <dd class="text-gray-900 dark:text-white font-medium">{{ $order->order_number }}</dd>
                        </div>
                        <div class="flex justify-between print:text-sm">
                            <dt class="text-gray-600 dark:text-gray-400">Date:</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $order->created_at->format('M j, Y g:i A') }}</dd>
                        </div>
                        <div class="flex justify-between print:text-sm">
                            <dt class="text-gray-600 dark:text-gray-400">Cashier:</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $order->cashier_name }}</dd>
                        </div>
                        <div class="flex justify-between print:text-sm">
                            <dt class="text-gray-600 dark:text-gray-400">Total Items:</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $order->total_items }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Payment Summary -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 print:text-base print:mb-2">Payment Summary</h3>
                    <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 print:bg-gray-100 print:p-2">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-900 dark:text-white print:text-base">Total Amount:</span>
                            <span class="text-2xl font-bold text-green-600 dark:text-green-400 print:text-lg">{{ $order->formatted_total }}</span>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 print:text-xs print:mt-1">Payment Method: Cash</p>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-8 print:pt-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 print:text-base print:mb-3">Order Items</h3>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="text-left py-3 text-sm font-medium text-gray-600 dark:text-gray-400 print:py-1 print:text-xs">Product</th>
                                <th class="text-center py-3 text-sm font-medium text-gray-600 dark:text-gray-400 print:py-1 print:text-xs">Qty</th>
                                <th class="text-right py-3 text-sm font-medium text-gray-600 dark:text-gray-400 print:py-1 print:text-xs">Unit Price</th>
                                <th class="text-right py-3 text-sm font-medium text-gray-600 dark:text-gray-400 print:py-1 print:text-xs">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($order->orderItems as $item)
                                <tr>
                                    <td class="py-4 print:py-2">
                                        <div class="flex items-center space-x-3 print:space-x-2">
                                            @if($item->product->image)
                                                <div class="w-12 h-12 bg-gray-200 dark:bg-gray-600 rounded-lg overflow-hidden flex-shrink-0 print:w-8 print:h-8">
                                                    <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                                </div>
                                            @endif
                                            <div>
                                                <p class="text-sm font-medium text-gray-900 dark:text-white print:text-xs">{{ $item->product->name }}</p>
                                                @if($item->product->description)
                                                    <p class="text-xs text-gray-500 dark:text-gray-400 print:hidden">{{ Str::limit($item->product->description, 50) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 text-center text-sm text-gray-900 dark:text-white print:py-2 print:text-xs">{{ $item->quantity }}</td>
                                    <td class="py-4 text-right text-sm text-gray-900 dark:text-white print:py-2 print:text-xs">{{ $item->formatted_unit_price }}</td>
                                    <td class="py-4 text-right text-sm font-medium text-gray-900 dark:text-white print:py-2 print:text-xs">{{ $item->formatted_subtotal }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-t-2 border-gray-300 dark:border-gray-600">
                                <td colspan="3" class="py-4 text-right text-lg font-semibold text-gray-900 dark:text-white print:py-2 print:text-base">Total:</td>
                                <td class="py-4 text-right text-xl font-bold text-green-600 dark:text-green-400 print:py-2 print:text-lg">{{ $order->formatted_total }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Footer -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-8 mt-8 text-center print:pt-4 print:mt-4">
                <p class="text-gray-600 dark:text-gray-400 text-sm print:text-xs">Thank you for your business!</p>
                <p class="text-gray-500 dark:text-gray-500 text-xs mt-2 print:mt-1">
                    Order ID: {{ $order->id }} | Generated on {{ now()->format('M j, Y g:i A') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Print Styles -->
    <style>
    @media print {
        body {
            font-size: 12px;
            line-height: 1.3;
        }
        
        .print\:hidden {
            display: none !important;
        }
        
        .print\:block {
            display: block !important;
        }
        
        .print\:text-center {
            text-align: center !important;
        }
        
        .print\:text-xs {
            font-size: 0.75rem !important;
        }
        
        .print\:text-sm {
            font-size: 0.875rem !important;
        }
        
        .print\:text-base {
            font-size: 1rem !important;
        }
        
        .print\:text-lg {
            font-size: 1.125rem !important;
        }
        
        .print\:w-8 {
            width: 2rem !important;
        }
        
        .print\:h-8 {
            height: 2rem !important;
        }
        
        .print\:w-12 {
            width: 3rem !important;
        }
        
        .print\:h-12 {
            height: 3rem !important;
        }
        
        .print\:p-2 {
            padding: 0.5rem !important;
        }
        
        .print\:p-4 {
            padding: 1rem !important;
        }
        
        .print\:py-1 {
            padding-top: 0.25rem !important;
            padding-bottom: 0.25rem !important;
        }
        
        .print\:py-2 {
            padding-top: 0.5rem !important;
            padding-bottom: 0.5rem !important;
        }
        
        .print\:mb-2 {
            margin-bottom: 0.5rem !important;
        }
        
        .print\:mb-3 {
            margin-bottom: 0.75rem !important;
        }
        
        .print\:mt-1 {
            margin-top: 0.25rem !important;
        }
        
        .print\:mt-4 {
            margin-top: 1rem !important;
        }
        
        .print\:gap-4 {
            gap: 1rem !important;
        }
        
        .print\:space-x-2 > * + * {
            margin-left: 0.5rem !important;
        }
        
        .print\:bg-white {
            background-color: white !important;
        }
        
        .print\:bg-gray-100 {
            background-color: #f3f4f6 !important;
        }
        
        .print\:shadow-none {
            box-shadow: none !important;
        }
        
        .print\:border-none {
            border: none !important;
        }
        
        .print\:rounded-none {
            border-radius: 0 !important;
        }
        
        .print\:grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }
    }
    </style>
</div>
</div>
</div>