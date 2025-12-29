<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class LanguageSwitcher extends Component
{
    public string $currentLocale;

    public function mount()
    {
        $this->currentLocale = App::getLocale();
    }

    public function switchLanguage($locale)
    {
        // Validate locale
        if (!array_key_exists($locale, config('app.available_locales'))) {
            return;
        }

        // Store in session
        Session::put('locale', $locale);
        
        // Set current locale
        App::setLocale($locale);
        $this->currentLocale = $locale;

        // Dispatch event to refresh other components
        $this->dispatch('localeChanged', locale: $locale);
        $this->dispatch('currencyChanged', locale: $locale);

        // Use JavaScript to refresh the page instead of Laravel redirect
        $this->js('window.location.reload()');
    }

    public function render()
    {
        return view('livewire.components.language-switcher');
    }
}