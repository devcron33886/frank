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
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ number_format(\App\MyFunc::counts('orders')) }}</h3>

                                <p>Total Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('admin.orders.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ number_format(\App\MyFunc::countOrdersByStatus('Completed')) }}</h3>

                                <p>Completed Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('admin.orders.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ number_format(\App\MyFunc::countOrdersByStatus('Pending')) }}</h3>

                                <p>Pending Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('admin.orders.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>

                                <p>Unique Visitors</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ number_format(\App\MyFunc::counts('orders')) }}</h3>

                                <p>Total Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('admin.orders.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ number_format(\App\MyFunc::countOrdersByStatus('Completed')) }}</h3>

                                <p>Completed Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('admin.orders.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ number_format(\App\MyFunc::countOrdersByStatus('Pending')) }}</h3>

                                <p>Pending Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('admin.orders.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>

                                <p>Unique Visitors</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-7 connectedSortable ui-sortable">
                        <!-- Recent Orders-->
                        <x-recent-orders-component/>
                        <!-- /.card -->

                        <!-- DIRECT CHAT -->
                        <div class="card direct-chat direct-chat-primary">
                            <div class="card-header ui-sortable-handle" style="cursor: move;">
                                <h3 class="card-title">Direct Chat</h3>

                                <div class="card-tools">
                                    <span data-toggle="tooltip" title="3 New Messages"
                                        class="badge badge-primary">3</span>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts"
                                        data-widget="chat-pane-toggle">
                                        <i class="fas fa-comments"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                            class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- Conversations are loaded here -->
                                <div class="direct-chat-messages">
                                    <!-- Message. Default to the left -->
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-left">Alexander Pierce</span>
                                            <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img" src="dist/img/user1-128x128.jpg"
                                            alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            Is this template really for free? That's unbelievable!
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

                                    <!-- Message to the right -->
                                    <div class="direct-chat-msg right">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-right">Sarah Bullock</span>
                                            <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img" src="dist/img/user3-128x128.jpg"
                                            alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            You better believe it!
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

                                    <!-- Message. Default to the left -->
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-left">Alexander Pierce</span>
                                            <span class="direct-chat-timestamp float-right">23 Jan 5:37 pm</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img" src="dist/img/user1-128x128.jpg"
                                            alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            Working with AdminLTE on a great new app! Wanna join?
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

                                    <!-- Message to the right -->
                                    <div class="direct-chat-msg right">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-right">Sarah Bullock</span>
                                            <span class="direct-chat-timestamp float-left">23 Jan 6:10 pm</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img" src="dist/img/user3-128x128.jpg"
                                            alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            I would love to.
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

                                </div>
                                <!--/.direct-chat-messages-->

                                <!-- Contacts are loaded here -->
                                <div class="direct-chat-contacts">
                                    <ul class="contacts-list">
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img" src="dist/img/user1-128x128.jpg">

                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Count Dracula
                                                        <small class="contacts-list-date float-right">2/28/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">How have you been? I was...</span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img" src="dist/img/user7-128x128.jpg">

                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Sarah Doe
                                                        <small class="contacts-list-date float-right">2/23/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">I will be waiting for...</span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img" src="dist/img/user3-128x128.jpg">

                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Nadia Jolie
                                                        <small class="contacts-list-date float-right">2/20/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">I'll call you back at...</span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img" src="dist/img/user5-128x128.jpg">

                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Nora S. Vans
                                                        <small class="contacts-list-date float-right">2/10/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">Where is your new...</span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img" src="dist/img/user6-128x128.jpg">

                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        John K.
                                                        <small class="contacts-list-date float-right">1/27/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">Can I take a look at...</span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img" src="dist/img/user8-128x128.jpg">

                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Kenneth M.
                                                        <small class="contacts-list-date float-right">1/4/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">Never mind I found...</span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                    </ul>
                                    <!-- /.contacts-list -->
                                </div>
                                <!-- /.direct-chat-pane -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <form action="#" method="post">
                                    <div class="input-group">
                                        <input type="text" name="message" placeholder="Type Message ..."
                                            class="form-control">
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-primary">Send</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                        <!--/.direct-chat -->

                        <!-- TO DO List -->
                        <div class="card">
                            <div class="card-header ui-sortable-handle" style="cursor: move;">
                                <h3 class="card-title">
                                    <i class="ion ion-clipboard mr-1"></i>
                                    To Do List
                                </h3>

                                <div class="card-tools">
                                    <ul class="pagination pagination-sm">
                                        <li class="page-item"><a href="#" class="page-link">«</a></li>
                                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                                        <li class="page-item"><a href="#" class="page-link">3</a></li>
                                        <li class="page-item"><a href="#" class="page-link">»</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <ul class="todo-list ui-sortable" data-widget="todo-list">
                                    <li>
                                        <!-- drag handle -->
                                        <span class="handle ui-sortable-handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <!-- checkbox -->
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value="" name="todo1" id="todoCheck1">
                                            <label for="todoCheck1"></label>
                                        </div>
                                        <!-- todo text -->
                                        <span class="text">Design a nice theme</span>
                                        <!-- Emphasis label -->
                                        <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small>
                                        <!-- General tools such as edit or delete-->
                                        <div class="tools">
                                            <i class="fas fa-edit"></i>
                                            <i class="fas fa-trash-o"></i>
                                        </div>
                                    </li>
                                    <li class="done">
                                        <span class="handle ui-sortable-handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value="" name="todo2" id="todoCheck2"
                                                checked="">
                                            <label for="todoCheck2"></label>
                                        </div>
                                        <span class="text">Make the theme responsive</span>
                                        <small class="badge badge-info"><i class="far fa-clock"></i> 4 hours</small>
                                        <div class="tools">
                                            <i class="fas fa-edit"></i>
                                            <i class="fas fa-trash-o"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="handle ui-sortable-handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value="" name="todo3" id="todoCheck3">
                                            <label for="todoCheck3"></label>
                                        </div>
                                        <span class="text">Let theme shine like a star</span>
                                        <small class="badge badge-warning"><i class="far fa-clock"></i> 1 day</small>
                                        <div class="tools">
                                            <i class="fas fa-edit"></i>
                                            <i class="fas fa-trash-o"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="handle ui-sortable-handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value="" name="todo4" id="todoCheck4">
                                            <label for="todoCheck4"></label>
                                        </div>
                                        <span class="text">Let theme shine like a star</span>
                                        <small class="badge badge-success"><i class="far fa-clock"></i> 3 days</small>
                                        <div class="tools">
                                            <i class="fas fa-edit"></i>
                                            <i class="fas fa-trash-o"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="handle ui-sortable-handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value="" name="todo5" id="todoCheck5">
                                            <label for="todoCheck5"></label>
                                        </div>
                                        <span class="text">Check your messages and notifications</span>
                                        <small class="badge badge-primary"><i class="far fa-clock"></i> 1 week</small>
                                        <div class="tools">
                                            <i class="fas fa-edit"></i>
                                            <i class="fas fa-trash-o"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="handle ui-sortable-handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value="" name="todo6" id="todoCheck6">
                                            <label for="todoCheck6"></label>
                                        </div>
                                        <span class="text">Let theme shine like a star</span>
                                        <small class="badge badge-secondary"><i class="far fa-clock"></i> 1 month</small>
                                        <div class="tools">
                                            <i class="fas fa-edit"></i>
                                            <i class="fas fa-trash-o"></i>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <button type="button" class="btn btn-info float-right"><i class="fas fa-plus"></i> Add
                                    item</button>
                            </div>
                        </div>
                        <!-- /.card -->
                    </section>
                    <!-- /.Left col -->
                    <!-- right col (We are only adding the ID to make the widgets sortable)-->
                    <section class="col-lg-5 connectedSortable ui-sortable">

                        <!-- Map card -->
                        <x-top-selling-products-component/>
                        <!-- /.card -->

                        <!-- solid sales graph -->
                        <div class="card bg-gradient-info">
                            <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                                <h3 class="card-title">
                                    <i class="fas fa-th mr-1"></i>
                                    Sales Graph
                                </h3>

                                <div class="card-tools">
                                    <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas class="chart chartjs-render-monitor" id="line-chart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 319px;"
                                    width="957" height="750"></canvas>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer bg-transparent">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <div style="display:inline;width:60px;height:60px;"><canvas width="60"
                                                height="60"></canvas><input type="text" class="knob"
                                                data-readonly="true" value="20" data-width="60" data-height="60"
                                                data-fgcolor="#39CCCC" readonly="readonly"
                                                style="width: 34px; height: 20px; position: absolute; vertical-align: middle; margin-top: 20px; margin-left: -47px; border: 0px; background: none; font: bold 12px Arial; text-align: center; color: rgb(57, 204, 204); padding: 0px; appearance: none;">
                                        </div>

                                        <div class="text-white">Mail-Orders</div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-4 text-center">
                                        <div style="display:inline;width:60px;height:60px;"><canvas width="60"
                                                height="60"></canvas><input type="text" class="knob"
                                                data-readonly="true" value="50" data-width="60" data-height="60"
                                                data-fgcolor="#39CCCC" readonly="readonly"
                                                style="width: 34px; height: 20px; position: absolute; vertical-align: middle; margin-top: 20px; margin-left: -47px; border: 0px; background: none; font: bold 12px Arial; text-align: center; color: rgb(57, 204, 204); padding: 0px; appearance: none;">
                                        </div>

                                        <div class="text-white">Online</div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-4 text-center">
                                        <div style="display:inline;width:60px;height:60px;"><canvas width="60"
                                                height="60"></canvas><input type="text" class="knob"
                                                data-readonly="true" value="30" data-width="60" data-height="60"
                                                data-fgcolor="#39CCCC" readonly="readonly"
                                                style="width: 34px; height: 20px; position: absolute; vertical-align: middle; margin-top: 20px; margin-left: -47px; border: 0px; background: none; font: bold 12px Arial; text-align: center; color: rgb(57, 204, 204); padding: 0px; appearance: none;">
                                        </div>

                                        <div class="text-white">In-Store</div>
                                    </div>
                                    <!-- ./col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->

                        <!-- Calendar -->
                        <div class="card bg-gradient-success">
                            <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">

                                <h3 class="card-title">
                                    <i class="far fa-calendar-alt"></i>
                                    Calendar
                                </h3>
                                <!-- tools card -->
                                <div class="card-tools">
                                    <!-- button with a dropdown -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                            data-toggle="dropdown">
                                            <i class="fas fa-bars"></i></button>
                                        <div class="dropdown-menu float-right" role="menu">
                                            <a href="#" class="dropdown-item">Add new event</a>
                                            <a href="#" class="dropdown-item">Clear events</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item">View calendar</a>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <!-- /. tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body pt-0">
                                <!--The calendar -->
                                <div id="calendar" style="width: 100%">
                                    <div class="bootstrap-datetimepicker-widget usetwentyfour">
                                        <ul class="list-unstyled">
                                            <li class="show">
                                                <div class="datepicker">
                                                    <div class="datepicker-days" style="">
                                                        <table class="table table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th class="prev" data-action="previous"><span
                                                                            class="fa fa-chevron-left"
                                                                            title="Previous Month"></span></th>
                                                                    <th class="picker-switch" data-action="pickerSwitch"
                                                                        colspan="5" title="Select Month">August 2022
                                                                    </th>
                                                                    <th class="next" data-action="next"><span
                                                                            class="fa fa-chevron-right"
                                                                            title="Next Month"></span></th>
                                                                </tr>
                                                                <tr>
                                                                    <th class="dow">Su</th>
                                                                    <th class="dow">Mo</th>
                                                                    <th class="dow">Tu</th>
                                                                    <th class="dow">We</th>
                                                                    <th class="dow">Th</th>
                                                                    <th class="dow">Fr</th>
                                                                    <th class="dow">Sa</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td data-action="selectDay" data-day="07/31/2022"
                                                                        class="day old weekend">31</td>
                                                                    <td data-action="selectDay" data-day="08/01/2022"
                                                                        class="day">1</td>
                                                                    <td data-action="selectDay" data-day="08/02/2022"
                                                                        class="day">2</td>
                                                                    <td data-action="selectDay" data-day="08/03/2022"
                                                                        class="day">3</td>
                                                                    <td data-action="selectDay" data-day="08/04/2022"
                                                                        class="day">4</td>
                                                                    <td data-action="selectDay" data-day="08/05/2022"
                                                                        class="day">5</td>
                                                                    <td data-action="selectDay" data-day="08/06/2022"
                                                                        class="day weekend">6</td>
                                                                </tr>
                                                                <tr>
                                                                    <td data-action="selectDay" data-day="08/07/2022"
                                                                        class="day weekend">7</td>
                                                                    <td data-action="selectDay" data-day="08/08/2022"
                                                                        class="day">8</td>
                                                                    <td data-action="selectDay" data-day="08/09/2022"
                                                                        class="day">9</td>
                                                                    <td data-action="selectDay" data-day="08/10/2022"
                                                                        class="day">10</td>
                                                                    <td data-action="selectDay" data-day="08/11/2022"
                                                                        class="day">11</td>
                                                                    <td data-action="selectDay" data-day="08/12/2022"
                                                                        class="day">12</td>
                                                                    <td data-action="selectDay" data-day="08/13/2022"
                                                                        class="day weekend">13</td>
                                                                </tr>
                                                                <tr>
                                                                    <td data-action="selectDay" data-day="08/14/2022"
                                                                        class="day weekend">14</td>
                                                                    <td data-action="selectDay" data-day="08/15/2022"
                                                                        class="day">15</td>
                                                                    <td data-action="selectDay" data-day="08/16/2022"
                                                                        class="day">16</td>
                                                                    <td data-action="selectDay" data-day="08/17/2022"
                                                                        class="day">17</td>
                                                                    <td data-action="selectDay" data-day="08/18/2022"
                                                                        class="day">18</td>
                                                                    <td data-action="selectDay" data-day="08/19/2022"
                                                                        class="day">19</td>
                                                                    <td data-action="selectDay" data-day="08/20/2022"
                                                                        class="day weekend">20</td>
                                                                </tr>
                                                                <tr>
                                                                    <td data-action="selectDay" data-day="08/21/2022"
                                                                        class="day weekend">21</td>
                                                                    <td data-action="selectDay" data-day="08/22/2022"
                                                                        class="day">22</td>
                                                                    <td data-action="selectDay" data-day="08/23/2022"
                                                                        class="day">23</td>
                                                                    <td data-action="selectDay" data-day="08/24/2022"
                                                                        class="day">24</td>
                                                                    <td data-action="selectDay" data-day="08/25/2022"
                                                                        class="day">25</td>
                                                                    <td data-action="selectDay" data-day="08/26/2022"
                                                                        class="day">26</td>
                                                                    <td data-action="selectDay" data-day="08/27/2022"
                                                                        class="day weekend">27</td>
                                                                </tr>
                                                                <tr>
                                                                    <td data-action="selectDay" data-day="08/28/2022"
                                                                        class="day weekend">28</td>
                                                                    <td data-action="selectDay" data-day="08/29/2022"
                                                                        class="day active today">29</td>
                                                                    <td data-action="selectDay" data-day="08/30/2022"
                                                                        class="day">30</td>
                                                                    <td data-action="selectDay" data-day="08/31/2022"
                                                                        class="day">31</td>
                                                                    <td data-action="selectDay" data-day="09/01/2022"
                                                                        class="day new">1</td>
                                                                    <td data-action="selectDay" data-day="09/02/2022"
                                                                        class="day new">2</td>
                                                                    <td data-action="selectDay" data-day="09/03/2022"
                                                                        class="day new weekend">3</td>
                                                                </tr>
                                                                <tr>
                                                                    <td data-action="selectDay" data-day="09/04/2022"
                                                                        class="day new weekend">4</td>
                                                                    <td data-action="selectDay" data-day="09/05/2022"
                                                                        class="day new">5</td>
                                                                    <td data-action="selectDay" data-day="09/06/2022"
                                                                        class="day new">6</td>
                                                                    <td data-action="selectDay" data-day="09/07/2022"
                                                                        class="day new">7</td>
                                                                    <td data-action="selectDay" data-day="09/08/2022"
                                                                        class="day new">8</td>
                                                                    <td data-action="selectDay" data-day="09/09/2022"
                                                                        class="day new">9</td>
                                                                    <td data-action="selectDay" data-day="09/10/2022"
                                                                        class="day new weekend">10</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="datepicker-months" style="display: none;">
                                                        <table class="table-condensed">
                                                            <thead>
                                                                <tr>
                                                                    <th class="prev" data-action="previous"><span
                                                                            class="fa fa-chevron-left"
                                                                            title="Previous Year"></span></th>
                                                                    <th class="picker-switch" data-action="pickerSwitch"
                                                                        colspan="5" title="Select Year">2022</th>
                                                                    <th class="next" data-action="next"><span
                                                                            class="fa fa-chevron-right"
                                                                            title="Next Year"></span></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="7"><span data-action="selectMonth"
                                                                            class="month">Jan</span><span
                                                                            data-action="selectMonth"
                                                                            class="month">Feb</span><span
                                                                            data-action="selectMonth"
                                                                            class="month">Mar</span><span
                                                                            data-action="selectMonth"
                                                                            class="month">Apr</span><span
                                                                            data-action="selectMonth"
                                                                            class="month">May</span><span
                                                                            data-action="selectMonth"
                                                                            class="month">Jun</span><span
                                                                            data-action="selectMonth"
                                                                            class="month">Jul</span><span
                                                                            data-action="selectMonth"
                                                                            class="month active">Aug</span><span
                                                                            data-action="selectMonth"
                                                                            class="month">Sep</span><span
                                                                            data-action="selectMonth"
                                                                            class="month">Oct</span><span
                                                                            data-action="selectMonth"
                                                                            class="month">Nov</span><span
                                                                            data-action="selectMonth"
                                                                            class="month">Dec</span></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="datepicker-years" style="display: none;">
                                                        <table class="table-condensed">
                                                            <thead>
                                                                <tr>
                                                                    <th class="prev" data-action="previous"><span
                                                                            class="fa fa-chevron-left"
                                                                            title="Previous Decade"></span></th>
                                                                    <th class="picker-switch" data-action="pickerSwitch"
                                                                        colspan="5" title="Select Decade">2020-2029
                                                                    </th>
                                                                    <th class="next" data-action="next"><span
                                                                            class="fa fa-chevron-right"
                                                                            title="Next Decade"></span></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="7"><span data-action="selectYear"
                                                                            class="year old">2019</span><span
                                                                            data-action="selectYear"
                                                                            class="year">2020</span><span
                                                                            data-action="selectYear"
                                                                            class="year">2021</span><span
                                                                            data-action="selectYear"
                                                                            class="year active">2022</span><span
                                                                            data-action="selectYear"
                                                                            class="year">2023</span><span
                                                                            data-action="selectYear"
                                                                            class="year">2024</span><span
                                                                            data-action="selectYear"
                                                                            class="year">2025</span><span
                                                                            data-action="selectYear"
                                                                            class="year">2026</span><span
                                                                            data-action="selectYear"
                                                                            class="year">2027</span><span
                                                                            data-action="selectYear"
                                                                            class="year">2028</span><span
                                                                            data-action="selectYear"
                                                                            class="year">2029</span><span
                                                                            data-action="selectYear"
                                                                            class="year old">2030</span></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="datepicker-decades" style="display: none;">
                                                        <table class="table-condensed">
                                                            <thead>
                                                                <tr>
                                                                    <th class="prev" data-action="previous"><span
                                                                            class="fa fa-chevron-left"
                                                                            title="Previous Century"></span></th>
                                                                    <th class="picker-switch" data-action="pickerSwitch"
                                                                        colspan="5">2000-2090</th>
                                                                    <th class="next" data-action="next"><span
                                                                            class="fa fa-chevron-right"
                                                                            title="Next Century"></span></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="7"><span data-action="selectDecade"
                                                                            class="decade old"
                                                                            data-selection="2006">1990</span><span
                                                                            data-action="selectDecade" class="decade"
                                                                            data-selection="2006">2000</span><span
                                                                            data-action="selectDecade" class="decade"
                                                                            data-selection="2016">2010</span><span
                                                                            data-action="selectDecade"
                                                                            class="decade active"
                                                                            data-selection="2026">2020</span><span
                                                                            data-action="selectDecade" class="decade"
                                                                            data-selection="2036">2030</span><span
                                                                            data-action="selectDecade" class="decade"
                                                                            data-selection="2046">2040</span><span
                                                                            data-action="selectDecade" class="decade"
                                                                            data-selection="2056">2050</span><span
                                                                            data-action="selectDecade" class="decade"
                                                                            data-selection="2066">2060</span><span
                                                                            data-action="selectDecade" class="decade"
                                                                            data-selection="2076">2070</span><span
                                                                            data-action="selectDecade" class="decade"
                                                                            data-selection="2086">2080</span><span
                                                                            data-action="selectDecade" class="decade"
                                                                            data-selection="2096">2090</span><span
                                                                            data-action="selectDecade"
                                                                            class="decade old"
                                                                            data-selection="2106">2100</span></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="picker-switch accordion-toggle"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </section>
                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
