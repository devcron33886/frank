<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CardProduct extends Component
{
    public $product;

    public $label;

    public $quantity;

    public function mount(Product $product, string $label)
    {
        $this->quantity = 1;
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.card-product', [
            'added' => Cart::get($this->product->id),
        ]);
    }

    public function add()
    {
        $product = $this->product;
        if ($product->status !== 'Available') {
            session()->flash('error', 'Product not available');
        }
        $cartItem = Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => $this->quantity,
            'price' => $product->getRealPrice(),
        ]);
        $cartItem->associate($product);

        $this->emit('productAdded');

        session()->flash('success', $product->name.' Successfully added to cart');
    }

    public function remove()
    {
        Cart::remove($this->product->id);
        $this->emit('productRemoved');

        session()->flash('success', $this->product->name.' Successfully removed to cart');
    }
}
