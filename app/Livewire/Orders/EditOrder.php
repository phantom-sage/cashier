<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class EditOrder extends Component
{
    use WithPagination;

    public Order $order;
    public string $search = '';
    public array $cart = [];
    public bool $loading = false;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function mount($id)
    {
        $this->order = Order::with(['orderItems.product'])->findOrFail($id);
        $this->loadOrderIntoCart();
    }

    public function loadOrderIntoCart()
    {
        $this->cart = [];
        
        foreach ($this->order->orderItems as $item) {
            $this->cart[$item->product_id] = [
                'product' => $item->product,
                'quantity' => $item->quantity,
                'unit_price' => $item->unit_price, // Keep original price
            ];
        }
        
        $this->calculateCartTotals();
    }

    public function updatingSearch()
    {
        $this->resetPage();
        $this->loading = true;
    }

    public function updatedSearch()
    {
        $this->loading = false;
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);
        
        if (!$product) {
            return;
        }

        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['quantity']++;
        } else {
            // For new products, use current price
            $this->cart[$productId] = [
                'product' => $product,
                'quantity' => 1,
                'unit_price' => $product->price,
            ];
        }

        $this->calculateCartTotals();
    }

    public function removeFromCart($productId)
    {
        unset($this->cart[$productId]);
        $this->calculateCartTotals();
    }

    public function updateQuantity($productId, $quantity)
    {
        if ($quantity < 1) {
            $this->removeFromCart($productId);
            return;
        }

        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['quantity'] = $quantity;
            $this->calculateCartTotals();
        }
    }

    public function incrementQuantity($productId)
    {
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['quantity']++;
            $this->calculateCartTotals();
        }
    }

    public function decrementQuantity($productId)
    {
        if (isset($this->cart[$productId])) {
            if ($this->cart[$productId]['quantity'] > 1) {
                $this->cart[$productId]['quantity']--;
                $this->calculateCartTotals();
            } else {
                $this->removeFromCart($productId);
            }
        }
    }

    public function calculateCartTotals()
    {
        foreach ($this->cart as $productId => &$item) {
            $item['subtotal'] = $item['quantity'] * $item['unit_price'];
        }
    }

    public function getTotalAmount()
    {
        return collect($this->cart)->sum('subtotal');
    }

    public function getFormattedTotal()
    {
        return '$' . number_format($this->getTotalAmount(), 2);
    }

    public function getTotalItems()
    {
        return collect($this->cart)->sum('quantity');
    }

    public function updateOrder()
    {
        if (empty($this->cart)) {
            session()->flash('error', __('app.order_must_have_items'));
            return;
        }

        try {
            DB::transaction(function () {
                // Update the order total
                $this->order->update([
                    'total_amount' => $this->getTotalAmount(),
                ]);

                // Delete existing order items
                $this->order->orderItems()->delete();

                // Create new order items
                foreach ($this->cart as $productId => $item) {
                    OrderItem::create([
                        'order_id' => $this->order->id,
                        'product_id' => $productId,
                        'quantity' => $item['quantity'],
                        'unit_price' => $item['unit_price'],
                        'subtotal' => $item['subtotal'],
                    ]);
                }
            });

            session()->flash('message', __('app.order_updated_success'));
            return redirect()->route('orders.receipt', $this->order->id);
        } catch (\Exception $e) {
            session()->flash('error', __('app.order_update_error'));
        }
    }

    public function render()
    {
        $products = Product::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(12);

        return view('livewire.orders.edit-order', [
            'products' => $products,
        ])->layout('layouts.app-modern');
    }
}