<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Models\Order;

class HomeController
{
    public function index()
    {
        $revenues = DB::table('orders')
        ->select(DB::raw('YEAR(orders.created_at) as year'), DB::raw('sum(order_items.sub_total) + orders.shipping_amount as amount'))
        ->join('order_items', 'order_items.order_id', '=', 'orders.id')
        ->join('products', 'products.id', '=', 'order_items.product_id')
        ->where('orders.status', '=', 'Paid')
        ->orderByDesc('year');
        // ->groupBy('year')->limit(5)->get()->sortBy('year')->values();
        return view('admin.home',compact('revenues'));
    }
}
