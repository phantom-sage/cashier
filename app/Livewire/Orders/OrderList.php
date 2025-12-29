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

    protected $listeners = ['currencyChanged' => '$refresh'];

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
    }

    public function cancelDelete()
    {
        $this->orderToDelete = null;
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

            // Flash success message
            session()->flash('message', __('app.order_deleted_success'));
            
            // Reset state
            $this->orderToDelete = null;
            
            // Redirect to refresh the page and clear any stale state
            return redirect()->route('orders.index');
            
        } catch (\Exception $e) {
            session()->flash('error', __('app.order_delete_error'));
            $this->orderToDelete = null;
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