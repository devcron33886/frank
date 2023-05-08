<?php

namespace App\View\Components;

use App\Models\Setting;
use Illuminate\View\Component;

class HeaderComponent extends Component
{
    public function __construct()
    {

    }

    public function render()
    {
        $settings = Setting::query()->first();

        return view('components.header-component', compact('settings'));
    }
}
