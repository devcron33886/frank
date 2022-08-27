<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ShoppingCartPage extends Component
{
    protected $listeners = ['productRemoved' => 'noop', 'productAdded' => 'noop'];

    public function noop()
    {
    }

    public function mount()
    {
    }

    public function render(): Factory|View|Application
    {
        $cart = Cart::getContent();
        $settings= Setting::first();

        return view('livewire.shopping-cart-page', compact('cart','settings'));
    }

    public function removeAll()
    {
        Cart::clear();

        $this->emit('productRemoved');
    }
}
