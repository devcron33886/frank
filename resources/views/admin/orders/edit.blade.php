@extends('layouts.admin')
@section('content')
    <div class="content-wrapper" style="min-height: 706px;">
        <!-- Content Header (Page header) -->
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
                    <div class="card-body">

                        <img src="{{ asset('img/GARDEN_LOGO.png') }}" alt="" style="max-height: 50px" />

                        <buton class="btn btn-primary float-right btn-sm no-print" onclick="window.print();">
                            <i class="fa fa-print"></i>
                            Print order
                        </buton>

                        <form method="POST" action="{{ route('admin.orders.update', [$order->id]) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" class="form-control" name="updated_by_id" value="{{ Auth::user()->id }}">
                            <table class="table table-responsive table-bordered mt-5" style="width: 100% !important;">
                                <tbody>
                                    <tr style="width: 100% !important;">
                                        <td style="width: 50% !important;">
                                            <span>
                                                <b>Oder No</b>
                                            </span>
                                        </td>
                                        <td style="width:50% !important;"> : {{ $order->order_no }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span>
                                                <b>Oder date</b>
                                            </span>
                                        </td>
                                        <td> : {{ date('j M Y h:i a', strtotime($order->created_at)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span>
                                                <b>Client</b>
                                            </span>
                                        </td>
                                        <td> : {{ $order->user === null ? $order->clientName : $order->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span>
                                                <b>Client phone</b>
                                            </span>
                                        </td>
                                        <td> : {{ \App\MyFunc::format_phone_us($order->clientPhone) }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span>
                                                <b>Email address</b>
                                            </span>
                                        </td>
                                        <td> : {{ $order->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span>
                                                <b>Delivery address</b>
                                            </span>
                                        </td>
                                        <td> : {{ $order->shipping_address }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <h4>Products ordered</h4>
                            <table class="table table-responsive table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 25% !improtant;">Product</th>
                                        <th style="width: 25% !improtant;">Price</th>
                                        <th style="width: 25% !improtant;">Qty</th>
                                        <th style="width: 25% !improtant;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $orderItem)
                                        <tr style="width: 100% !important">
                                            <td>{{ $orderItem->product->name }}</td>
                                            <td>{{ number_format($orderItem->price) }}</td>
                                            <td>{{ $orderItem->qty }}</td>
                                            <td>{{ number_format($orderItem->sub_total) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3">
                                            Sub Total:
                                        </th>
                                        <th>
                                            {{ $order->orderItems()->sum('sub_total') }} Rwf
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="3">
                                            Shipping:
                                        </th>
                                        <th>
                                            {{ number_format($order->shipping_amount) }} Rwf
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="3">
                                            Total:
                                        </th>
                                        <th>
                                            {{ number_format($order->getTotalAmountToPay()) }} Rwf
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="3">
                                            <strong class="text-success">Total amount to Pay:</strong>
                                        </th>
                                        <th>
                                            <strong class="text-success">
                                                {{ number_format($order->getTotalAmountToPay()) }} Rwf
                                            </strong>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div>
                                <p>
                                    <strong>Note:</strong>
                                    <span> {{ $order->notes }}</span>
                                </p>
                            </div>
                            <div class="form-group">
                                <label>{{ trans('cruds.order.fields.status') }}</label>
                                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}"
                                    name="status" id="status">
                                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                                        {{ trans('global.pleaseSelect') }}</option>
                                    @foreach (App\Models\Order::STATUS_SELECT as $key => $label)
                                        <option value="{{ $key }}"
                                            {{ old('status', $order->status) === (string) $key ? 'selected' : '' }}>
                                            {{ $label }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('status'))
                                    <span class="text-danger">{{ $errors->first('status') }}</span>
                                @endif

                            </div>
                            <div class="form-group">
                                <button class="btn btn-info" type="submit">
                                    Update Order Status
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
@endsection
