@extends('layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-wrapper" style="min-height: 706px;">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Orders</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        {{ trans('cruds.order.title_singular') }} {{ trans('global.list') }}
                    </div>

                    <div class="card-body">
                        <table class=" table table-bordered table-striped table-hover" id="ordersTable">
                            <thead>
                                <tr>

                                    <th>
                                        Order Date
                                    </th>
                                    <th>
                                        {{ trans('cruds.order.fields.order_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.order.fields.client_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.order.fields.client_phone') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.order.fields.shipping_address') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.order.fields.status') }}
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr >
                                        <td>
                                            {{ $order->created_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $order->order_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $order->clientName ?? '' }}
                                        </td>
                                        <td>
                                            {{ $order->clientPhone ?? '' }}
                                        </td>
                                        <td>
                                            {{ $order->shipping_address ?? '' }}
                                        </td>
                                        <td>
                                            @if ($order->status == 'Pending')
                                                <span class="badge badge-warning">{{ $order->status }}</span>
                                            @elseif($order->status == 'Processing')
                                                <span class="badge badge-info">{{ $order->status }}</span>
                                            @elseif($order->status == 'Delivered')
                                                <span class="badge badge-success">{{ $order->status }}</span>
                                            @elseif($order->status == 'Cancelled')
                                                <span class="badge badge-danger">{{ $order->status }}</span>
                                            @elseif($order->status == 'On Way')
                                                <span class="badge badge-primary">{{ $order->status }}</span>
                                            @elseif($order->status == 'Paid')
                                                <span class="badge badge-success">{{ $order->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-md btn-primary"
                                                href="{{ route('admin.orders.edit', $order->id) }}">
                                                <span class="fa fa-eye"></span> See Deatils
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination py-2 float-right">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function () {
          
          $('#ordersTable').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
          });
        });
      </script>
@endsection
