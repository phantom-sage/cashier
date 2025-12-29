@props(['mobile' => false])

@php
$linkClass = $mobile 
    ? 'flex items-center px-3 py-3 text-base font-medium rounded-lg transition-colors duration-200'
    : 'inline-flex items-center px-1 pt-1 text-sm font-medium';

$iconClass = $mobile 
    ? 'w-5 h-5 ' . (app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3')
    : 'w-4 h-4 ' . (app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2');
@endphp

<!-- Dashboard Link -->
<a href="{{ route('dashboard') }}" 
   class="{{ $linkClass }} {{ request()->routeIs('dashboard') 
       ? ($mobile 
           ? 'text-blue-600 bg-blue-50 dark:bg-blue-900/20 dark:text-blue-400' 
           : 'text-blue-600 border-b-2 border-blue-600') 
       : ($mobile 
           ? 'text-gray-700 dark:text-gray-300 hover:text-blue-600 hover:bg-gray-50 dark:hover:bg-gray-700 dark:hover:text-blue-400' 
           : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300') }}">
    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
    </svg>
    {{ __('app.dashboard') }}
</a>

<!-- Products Link -->
<a href="{{ route('products.index') }}" 
   class="{{ $linkClass }} {{ request()->routeIs('products.*') 
       ? ($mobile 
           ? 'text-blue-600 bg-blue-50 dark:bg-blue-900/20 dark:text-blue-400' 
           : 'text-blue-600 border-b-2 border-blue-600') 
       : ($mobile 
           ? 'text-gray-700 dark:text-gray-300 hover:text-blue-600 hover:bg-gray-50 dark:hover:bg-gray-700 dark:hover:text-blue-400' 
           : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300') }}">
    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
    </svg>
    {{ __('app.products') }}
</a>

<!-- Cashier Link -->
<a href="{{ route('orders.create') }}" 
   class="{{ $linkClass }} {{ request()->routeIs('orders.create') 
       ? ($mobile 
           ? 'text-green-600 bg-green-50 dark:bg-green-900/20 dark:text-green-400' 
           : 'text-green-600 border-b-2 border-green-600') 
       : ($mobile 
           ? 'text-gray-700 dark:text-gray-300 hover:text-green-600 hover:bg-gray-50 dark:hover:bg-gray-700 dark:hover:text-green-400' 
           : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300') }}">
    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
    </svg>
    {{ __('app.cashier') }}
</a>

<!-- Orders Link -->
<a href="{{ route('orders.index') }}" 
   class="{{ $linkClass }} {{ request()->routeIs('orders.index') || request()->routeIs('orders.receipt') 
       ? ($mobile 
           ? 'text-purple-600 bg-purple-50 dark:bg-purple-900/20 dark:text-purple-400' 
           : 'text-purple-600 border-b-2 border-purple-600') 
       : ($mobile 
           ? 'text-gray-700 dark:text-gray-300 hover:text-purple-600 hover:bg-gray-50 dark:hover:bg-gray-700 dark:hover:text-purple-400' 
           : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300') }}">
    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
    </svg>
    {{ __('app.orders') }}
</a>