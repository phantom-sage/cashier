<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class OrderList extends Component
{
    use WithPagination;

    public string $search = '';
    public bool $loading = false;
    public ?int $orderToDelete = null;
    public bool $showDeleteModal = false;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
        $this->loading = true;
    }

    public function updatedSearch()
    {
        $this->loading = false;
    }

    public function confirmDelete($orderId)
    {
        $this->orderToDelete = $orderId;
        $this->showDeleteModal = true;
    }

    public function cancelDelete()
    {
        $this->orderToDelete = null;
        $this->showDeleteModal = false;
    }

    public function deleteOrder()
    {
        if (!$this->orderToDelete) {
            return;
        }

        try {
            DB::transaction(function () {
                $order = Order::findOrFail($this->orderToDelete);
                
                // Delete order items first (cascade should handle this, but being explicit)
                $order->orderItems()->delete();
                
                // Delete the order
                $order->delete();
            });

            session()->flash('message', 'Order deleted successfully.');
            $this->cancelDelete();
            
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete order. Please try again.');
            $this->cancelDelete();
        }
    }

    public function render()
    {
        $orders = Order::with(['orderItems.product', 'user'])
            ->when($this->search, function ($query) {
                $query->where('cashier_name', 'like', '%' . $this->search . '%')
                      ->orWhere('id', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(15);

        return view('livewire.orders.order-list', [
            'orders' => $orders,
        ])->layout('layouts.app-modern');
    }
}