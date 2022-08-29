<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'        => 'Revenues',
            'chart_type'         => 'line',
            'report_type'        => 'group_by_string',
            'model'              => 'App\Models\Order',
            'group_by_field'     => 'orders.status=Paid',
            'model'              =>'App\Models\OrderItem',
            'group_by_field'     => 'sum(order_items.subtotals)+orders.shipping_amount',
            'aggregate_function' => 'sum',
            'filter_period'      => 'year',

        ];

        $chart1 = new LaravelChart($settings1);

        return view('admin.home', compact('chart1'));
    }
}