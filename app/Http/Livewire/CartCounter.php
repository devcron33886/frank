<?php

namespace App\Http\Livewire;

use Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CartCounter extends Component
{
    protected $listeners = ['productAdded' => 'update', 'productRemoved' => 'update'];

    public function update()
    {
    }

    public function render()
    {
        return view('livewire.cart-counter', [
            'count' => Cart::getTotalQuantity(),
        ]);
    }
}
