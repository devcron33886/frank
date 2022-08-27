<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CartItem extends Component
{
    public $product;

    public $cartItem;

    public $quantity;

    public function mount(Product $product, $cartItem)
    {
        $this->quantity = $cartItem->quantity;
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.cart-item', [
            'product' => $this->product,
            'cartItem' => $this->cartItem,
        ]);
    }

    public function update()
    {
        $this->skipRender();

        $product = $this->product;
        $quantity = $this->quantity;
        if ($product->status !== 'Available' || $quantity <= 0) {
            session()->flash('error', 'Product not available');
        }

        $id = $product->id;
        Cart::remove($id);

        $cartItem = Cart::add([
            'id' => $id,
            'name' => $product->name,
            'quantity' => $quantity,
            'price' => $product->getRealPrice(),
        ]);
        $cartItem->associate($product);

        $this->emit('productAdded');
        session()->flash('success', $product->name.' Successfully added to cart');
    }

    public function remove()
    {
        $this->skipRender();

        $product = $this->product;
        Cart::remove($product->id);
        $this->emit('productRemoved');

        session()->flash('success', $product->name.' Successfully removed to cart');
    }
}
