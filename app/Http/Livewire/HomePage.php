<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class HomePage extends Component
{
    public $slides;

    public $categories;

    public function mount($slides, $categories)
    {
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.home-page');
    }
}
