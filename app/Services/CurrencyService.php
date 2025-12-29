<?php

namespace App\Services;

use Illuminate\Support\Facades\App;

class CurrencyService
{
    /**
     * Currency configuration per locale
     */
    private static array $currencies = [
        'en' => [
            'symbol' => 'SDG',
            'name' => 'Sudanese Pound',
            'position' => 'after', // symbol after amount
            'decimal_separator' => '.',
            'thousands_separator' => ',',
            'decimals' => 2,
        ],
        'ar' => [
            'symbol' => 'ج.س',
            'name' => 'الجنيه السوداني',
            'position' => 'after', // symbol after amount
            'decimal_separator' => '٫',
            'thousands_separator' => '٬',
            'decimals' => 2,
        ],
    ];

    /**
     * Format currency amount based on current locale
     */
    public static function format(float|int|string $amount, ?string $locale = null): string
    {
        $locale = $locale ?? App::getLocale();
        $config = self::$currencies[$locale] ?? self::$currencies['en'];
        
        // Convert to float and ensure precision
        $amount = (float) $amount;
        
        // Format number with locale-specific separators
        $formattedAmount = number_format(
            $amount,
            $config['decimals'],
            $config['decimal_separator'],
            $config['thousands_separator']
        );
        
        // Convert to Arabic-Indic numerals if Arabic locale and enabled
        if ($locale === 'ar' && config('app.use_arabic_numerals', false)) {
            $formattedAmount = self::convertToArabicNumerals($formattedAmount);
        }
        
        // Add currency symbol based on position
        return $config['position'] === 'before' 
            ? $config['symbol'] . ' ' . $formattedAmount
            : $formattedAmount . ' ' . $config['symbol'];
    }

    /**
     * Get currency symbol for current locale
     */
    public static function getSymbol(?string $locale = null): string
    {
        $locale = $locale ?? App::getLocale();
        return self::$currencies[$locale]['symbol'] ?? self::$currencies['en']['symbol'];
    }

    /**
     * Get currency name for current locale
     */
    public static function getName(?string $locale = null): string
    {
        $locale = $locale ?? App::getLocale();
        return self::$currencies[$locale]['name'] ?? self::$currencies['en']['name'];
    }

    /**
     * Convert Western numerals to Arabic-Indic numerals
     */
    private static function convertToArabicNumerals(string $number): string
    {
        $western = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        
        return str_replace($western, $arabic, $number);
    }

    /**
     * Get all available currencies
     */
    public static function getAllCurrencies(): array
    {
        return self::$currencies;
    }

    /**
     * Check if locale has currency configuration
     */
    public static function hasLocale(string $locale): bool
    {
        return isset(self::$currencies[$locale]);
    }
}