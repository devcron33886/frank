<div class="card">
    <div class="card-header ui-sortable-handle" style="cursor: move;">
        <h3 class="card-title">
            <i class="fas fa-shopping-cart mr-1"></i>
            Recent Orders
        </h3>

    </div><!-- /.card-header -->
    <div class="card-body">
        <table class="table table-responsive table-stripped" style="width: 100%">
            <thead>
                <tr>
                    <th>Date &amp; Time</th>
                    <th>Order No.</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach (\App\MyFunc::recentOrders() as $order)
                    <tr>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->order_no }}</td>
                        <td>{{ $order->clientName }}</td>
                        <td>{{ number_format($order->orderItems()->sum('sub_total') + $order->shipping_amount) }}
                        </td>
                        <td>
                            @if ($order->status == 'Pending')
                                <span class="badge badge-warning">{{ $order->status }}</span>
                            @elseif($order->status == 'Processing')
                                <span class="badge badge-info">{{ $order->status }}</span>
                            @elseif($order->status == 'Completed')
                                <span class="badge badge-info">{{ $order->status }}</span>
                            @elseif($order->status == 'On Way')
                                <span class="badge badge-warning">{{ $order->status }}</span>
                            @elseif($order->status == 'Delivered')
                                <span class="badge badge-success">{{ $order->status }}</span>
                            @elseif($order->status == 'Paid')
                                <span class="badge badge-success">{{ $order->status }}</span>
                            @elseif($order->status == 'Cancelled')
                                <span class="badge badge-danger">{{ $order->status }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- /.card-body -->
</div>
