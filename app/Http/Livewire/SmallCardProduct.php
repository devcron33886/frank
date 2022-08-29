<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SmallCardProduct extends Component
{
    public $product;

    public function mount(Product $product)
    {
    }

    public function render()
    {
        return view('livewire.small-card-product', [
            'added' => Cart::get($this->product->id),
        ]);
    }
}
