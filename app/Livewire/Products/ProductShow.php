<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class ProductShow extends Component
{
    public Product $product;

    public function mount($id)
    {
        $this->product = Product::findOrFail($id);
    }

    public function deleteProduct()
    {
        // Delete image file if exists
        if ($this->product->image && file_exists(public_path($this->product->image))) {
            unlink(public_path($this->product->image));
        }
        
        $this->product->delete();
        
        session()->flash('message', 'Product deleted successfully.');
        
        return redirect()->route('products.index');
    }

    public function render()
    {
        return view('livewire.products.product-show')->layout('layouts.app-modern');
    }
}