<?php

use App\Services\CurrencyService;

if (!function_exists('currency')) {
    /**
     * Format currency amount based on current locale
     */
    function currency(float|int|string $amount, ?string $locale = null): string
    {
        return CurrencyService::format($amount, $locale);
    }
}

if (!function_exists('currency_symbol')) {
    /**
     * Get currency symbol for current locale
     */
    function currency_symbol(?string $locale = null): string
    {
        return CurrencyService::getSymbol($locale);
    }
}

if (!function_exists('currency_name')) {
    /**
     * Get currency name for current locale
     */
    function currency_name(?string $locale = null): string
    {
        return CurrencyService::getName($locale);
    }
}