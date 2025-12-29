<?php

namespace App\Livewire\Components;

use Livewire\Component;

class MobileNavigation extends Component
{
    public bool $isOpen = false;

    public function toggleMenu()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function closeMenu()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.components.mobile-navigation');
    }
}