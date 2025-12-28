<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductCreate extends Component
{
    use WithFileUploads;

    public $name = '';
    public $description = '';
    public $price = '';
    public $image;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|max:2048', // 2MB Max
    ];

    public function save()
    {
        $this->validate();

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('products', 'public');
        }

        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $imagePath ? 'storage/' . $imagePath : null,
        ]);

        session()->flash('message', 'Product created successfully.');
        
        return redirect()->route('products.index');
    }

    public function render()
    {
        return view('livewire.products.product-create')->layout('layouts.app-modern');
    }
}