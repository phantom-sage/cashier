<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class CreateOrder extends Component
{
    use WithPagination;

    public string $search = '';
    public array $cart = [];
    public bool $loading = false;

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

    public function addToCart($productId)
    {
        $product = Product::find($productId);
        
        if (!$product) {
            return;
        }

        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['quantity']++;
        } else {
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

    public function clearCart()
    {
        $this->cart = [];
    }

    public function checkout()
    {
        if (empty($this->cart)) {
            session()->flash('error', 'Cart is empty. Please add products before checkout.');
            return;
        }

        try {
            DB::transaction(function () {
                // Create the order
                $order = Order::create([
                    'total_amount' => $this->getTotalAmount(),
                    'cashier_name' => auth()->user()->name,
                    'user_id' => auth()->id(),
                ]);

                // Create order items
                foreach ($this->cart as $productId => $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $productId,
                        'quantity' => $item['quantity'],
                        'unit_price' => $item['unit_price'],
                        'subtotal' => $item['subtotal'],
                    ]);
                }

                // Clear the cart
                $this->clearCart();

                // Redirect to receipt
                session()->flash('message', 'Order created successfully!');
                return redirect()->route('orders.receipt', $order->id);
            });
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create order. Please try again.');
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

        return view('livewire.orders.create-order', [
            'products' => $products,
        ])->layout('layouts.app-modern');
    }
}