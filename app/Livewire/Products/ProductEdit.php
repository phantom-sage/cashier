<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductEdit extends Component
{
    use WithFileUploads;

    public Product $product;
    public $name = '';
    public $description = '';
    public $price = '';
    public $image;
    public $currentImage;

    public function mount($id)
    {
        $this->product = Product::findOrFail($id);
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->price = $this->product->price;
        $this->currentImage = $this->product->image;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:products,name,' . $this->product->id,
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048', // 2MB Max
        ];
    }

    public function update()
    {
        $this->validate();

        $imagePath = $this->currentImage;
        
        if ($this->image) {
            // Delete old image if exists
            if ($this->currentImage && file_exists(public_path($this->currentImage))) {
                unlink(public_path($this->currentImage));
            }
            
            $imagePath = 'storage/' . $this->image->store('products', 'public');
        }

        $this->product->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $imagePath,
        ]);

        session()->flash('message', 'Product updated successfully.');
        
        return redirect()->route('products.show', $this->product->id);
    }

    public function render()
    {
        return view('livewire.products.product-edit')->layout('layouts.app-modern');
    }
}