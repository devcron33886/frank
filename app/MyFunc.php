<?php

namespace App;

use App\Models\Order;
use App\Models\Setting;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class MyFunc
{
    public static function format_phone_us($phone)
    {
        // note: making sure we have something
        if (! isset($phone)) {
            return '';
        }
        // note: strip out everything but numbers
        $phone = preg_replace('/[^0-9]/', '', $phone);
        $length = strlen($phone);
        switch ($length) {
            case 7:
                return preg_replace('/([0-9]{3})([0-9]{4})/', '$1-$2', $phone);
            case 10:
                return preg_replace('/([0-9]{3})([0-9]{3})([0-9]{4})/', '($1) $2-$3', $phone);
            case 11:
                return preg_replace('/([0-9])([0-9]{3})([0-9]{3})([0-9]{4})/', '$1($2) $3-$4', $phone);
            default:
                return $phone;
                break;
        }
    }

    public static function counts($table)
    {
        return DB::table($table)->count();
    }

    public static function countOrdersByStatus($status)
    {
        return DB::table('orders')
            ->whereDate('created_at', date('Y-m-d'))
            ->where('status', $status)->count();
    }

    public static function countOrdersByStatusPercentage($status)
    {
        $totalByStatus = self::countOrdersByStatus($status);
        $totalOrders = Order::query()->whereDate('created_at', date('Y-m-d'))->count();

        return ($totalByStatus * 100) / ($totalOrders > 0 ? $totalOrders : 1);
    }

    public static function recentOrders()
    {
        return Order::with('orderItems')
            ->latest()
            ->limit(6)
            ->get();
    }

    public static function topSellingProducts(): Collection
    {
        return DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->select(DB::raw('products.name,count(products.id) AS total'))
            ->where('orders.status', '=', 'Paid')
            ->groupBy('products.id')
            ->groupBy('products.name')
            ->orderByDesc('total')
            ->orderBy('products.name')
            ->limit(6)->get();
    }

    public static function totalClients()
    {
        return count(
            DB::table('orders')
//                ->where('status', '=', "Delivered")
                ->select('clientName')
                ->groupBy('clientName')
                ->get()
        );
    }

    public static function toMoneyIncome()
    {
        return DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', '=','Paid')
            ->sum('order_items.sub_total');
    }

    public static function getDefaultSetting()
    {
        return Setting::orderBy('id', 'asc')->limit(1)->first();
    }
}
