<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use Livewire\Component;

class OrderReceipt extends Component
{
    public Order $order;

    protected $listeners = ['currencyChanged' => '$refresh'];

    public function mount($id)
    {
        $this->order = Order::with(['orderItems.product', 'user'])
            ->findOrFail($id);
    }

    public function printReceipt()
    {
        $this->dispatch('print-receipt');
    }

    public function render()
    {
        return view('livewire.orders.order-receipt')->layout('layouts.app-modern');
    }
}