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
                                        {{ trans('cruds.order.fields.id') }}
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
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $key => $order)
                                    <tr data-entry-id="{{ $order->id }}">
                                        
                                        <td>
                                            {{ $order->id ?? '' }}
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
                                            {{ $order->status ?? '' }}
                                        </td>
                                        <td>
                                            <a class="btn btn-xs btn-primary" href="{{ route('admin.orders.show', $order->id) }}">
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
    @endsection
    @section('scripts')
        @parent
        <script>
           
        </script>
    @endsection
