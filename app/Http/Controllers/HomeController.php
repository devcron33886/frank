<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HomeSlide;

class HomeController extends Controller
{
    public function index()
    {
        $slides = HomeSlide::query()->where('is_active', '=', true)->get();
        $categories = Category::query()->whereHas('products')->get();

        return view('home', compact('categories', 'slides'));
    }
}
