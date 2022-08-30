@extends('layouts.admin')
@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
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
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <x-numbers-component />

                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-7 connectedSortable ui-sortable">
                        <!-- Recent Orders-->
                        <x-recent-orders-component />
                        <!-- /.card -->

                        <!-- DIRECT CHAT -->
                        <div class="card">
                            <div class="card-header ui-sortable-handle" style="cursor: move;">
                                <h3 class="card-title">Sales Chart</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                {!! $chart1->renderHtml() !!}

                            </div>

                        </div>
                        <!--/.direct-chat -->


                        <!-- /.card -->
                    </section>
                    <!-- /.Left col -->
                    <!-- right col (We are only adding the ID to make the widgets sortable)-->
                    <section class="col-lg-5 connectedSortable ui-sortable">

                        <!-- Map card -->
                        <x-top-selling-products-component />
                        <!-- /.card -->

                        <!-- solid sales graph -->
                        <div class="card bg-gradient-info">
                            <div class="card-header ui-sortable-handle" style="cursor: move;">
                                <h3 class="card-title">
                                    <i class="fas fa-th mr-1"></i>
                                    Orders status
                                    <small class="text-muted">{{ date('M d Y') }}</small>
                                </h3>
                            </div>
                            <div class="card-body">

                                <ul class="list-unstyled">
                                    <li>
                                        <p>
                                            <span class="value">
                                                {{ number_format(\App\MyFunc::countOrdersByStatus(\App\Models\Order::PENDING)) }}
                                            </span>
                                            <span class="text-muted">Pending orders</span>
                                        </p>
                                        <div class="progress progress-xs progress-transparent custom-color-yellow">
                                            <div class="progress-bar" id="pending_status"
                                                data-transitiongoal="{{ \App\MyFunc::countOrdersByStatusPercentage(\App\Models\Order::PENDING) }}">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <p>
                                            <span class="value">
                                                {{ number_format(\App\MyFunc::countOrdersByStatus(\App\Models\Order::PROCESSING)) }}</span>
                                            <span class="text-muted">
                                                Processing orders
                                            </span>
                                        </p>
                                        <div class="progress progress-xs progress-transparent custom-color-purple">
                                            <div id="processing_status" class="progress-bar"
                                                data-transitiongoal="{{ \App\MyFunc::countOrdersByStatusPercentage(\App\Models\Order::PROCESSING) }}">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <p>
                                            <span class="value">
                                                {{ number_format(\App\MyFunc::countOrdersByStatus(\App\Models\Order::ON_WAY)) }}
                                            </span>
                                            <span class="text-muted">On the way orders</span>
                                        </p>
                                        <div class="progress progress-xs progress-transparent custom-color-lightseagreen"
                                            style="color: #5CB85C">
                                            <div class="progress-bar" id="shipped_status"
                                                data-transitiongoal="{{ \App\MyFunc::countOrdersByStatusPercentage(\App\Models\Order::ON_WAY) }}">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <p>
                                            <span class="value">
                                                {{ number_format(\App\MyFunc::countOrdersByStatus(\App\Models\Order::DELIVERED)) }}
                                            </span>
                                            <span class="text-muted">Delivered orders</span>
                                        </p>
                                        <div class="progress progress-xs progress-transparent custom-color-green"
                                            style="color: #5CB85C">
                                            <div class="progress-bar" id="delivered_status"
                                                data-transitiongoal="{{ \App\MyFunc::countOrdersByStatusPercentage(\App\Models\Order::DELIVERED) }}">
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <p>
                                            <span class="value">
                                                {{ number_format(\App\MyFunc::countOrdersByStatus(\App\MOdels\Order::CANCELLED)) }}
                                            </span>
                                            <span class="text-muted">Cancelled orders</span>
                                        </p>
                                        <div class="progress progress-xs progress-transparent custom-color-orange"
                                            style="color: #5CB85C">
                                            <div class="progress-bar" id="cancelled_status"
                                                data-transitiongoal="{{ \App\MyFunc::countOrdersByStatusPercentage(\App\Models\Order::CANCELLED) }}">
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card bg-gradient-success">
                            <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">

                                <h3 class="card-title">
                                    <i class="far fa-calendar-alt"></i>
                                    Calendar
                                </h3>

                            </div>

                            <div class="card-body pt-0">

                            </div>

                        </div>

                    </section>

                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
            <!-- Orders -->
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="panel-title"><i class="fa fa-square"></i> Summary</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{ number_format(\App\MyFunc::toMoneyIncome()) }} RWF</h3>

                                        <p>Total revenue</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-money"></i>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{ number_format(\App\MyFunc::counts('products')) }}</h3>

                                        <p>Total Products</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-product-hunt"></i>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-primary">
                                    <div class="inner">
                                        <h3>{{ number_format(\App\MyFunc::counts('categories')) }}</h3>

                                        <p>Total Categories</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-list-ul"></i>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{ number_format(\App\MyFunc::totalClients()) }}</h3>

                                        <p>Total Clients</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- END  -->
    </section>
    <!-- /.content -->
    </div>
@endsection
@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>{!! $chart1->renderJs() !!}
@endsection
