<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class AddCart extends Component
{
    public function render()
    {
        return view('livewire.add-cart');
    }
}
