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

        // Redirect to refresh the page with new locale
        return redirect()->to(request()->fullUrl());
    }

    public function render()
    {
        return view('livewire.components.language-switcher');
    }
}