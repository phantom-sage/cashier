<?php

use App\Services\CurrencyService;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

uses(TestCase::class);

beforeEach(function () {
    // Reset locale before each test
    App::setLocale('en');
});

it('formats currency for English locale', function () {
    App::setLocale('en');
    
    $formatted = CurrencyService::format(1250.50);
    
    expect($formatted)->toBe('1,250.50 SDG');
});

it('formats currency for Arabic locale with Western numerals', function () {
    App::setLocale('ar');
    config(['app.use_arabic_numerals' => false]);
    
    $formatted = CurrencyService::format(1250.50);
    
    expect($formatted)->toBe('1٬250٫50 ج.س');
});

it('formats currency for Arabic locale with Arabic numerals', function () {
    App::setLocale('ar');
    config(['app.use_arabic_numerals' => true]);
    
    $formatted = CurrencyService::format(1250.50);
    
    expect($formatted)->toBe('١٬٢٥٠٫٥٠ ج.س');
});

it('returns correct currency symbol for each locale', function () {
    App::setLocale('en');
    expect(CurrencyService::getSymbol())->toBe('SDG');
    
    App::setLocale('ar');
    expect(CurrencyService::getSymbol())->toBe('ج.س');
});

it('returns correct currency name for each locale', function () {
    App::setLocale('en');
    expect(CurrencyService::getName())->toBe('Sudanese Pound');
    
    App::setLocale('ar');
    expect(CurrencyService::getName())->toBe('الجنيه السوداني');
});

it('uses helper functions correctly', function () {
    App::setLocale('en');
    
    expect(currency(100))->toBe('100.00 SDG');
    expect(currency_symbol())->toBe('SDG');
    expect(currency_name())->toBe('Sudanese Pound');
});