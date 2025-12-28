<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public string $search = '';
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
        // Add to cart logic here
        session()->flash('message', 'Product added to cart!');
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

        return view('livewire.products.product-list', [
            'products' => $products,
        ])->layout('layouts.app-modern');
    }
}