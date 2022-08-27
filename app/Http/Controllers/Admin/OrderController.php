<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\UpdateOrderRequest;
use App\Notifications\OrderUpdatedNotification;
use App\Models\Order;
use App\Models\User;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::with(['updated_by'])->get();

        return view('admin.orders.index', compact('orders'));
    }

    

    public function edit(Order $order)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        return view('admin.orders.edit', compact('order'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update(['status' => $request->status,'updated_by_id' => auth()->id()]);
        User::all()->except($order->updated_by->id)->each(function (User $user) use ($order) {
            $user->notify(new OrderUpdatedNotification($order));
        });
        

        return redirect()->route('admin.orders.index');
    }

    
}
