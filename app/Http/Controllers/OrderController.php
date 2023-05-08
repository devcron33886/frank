<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function orderSuccess($id)
    {
        $order = Order::find(decryptId($id));
        if (! $order) {
            abort(404);
        }

        return view('clients.order-success', ['order' => $order])
            ->with('message', ' You successfully placed orders');
    }
}
