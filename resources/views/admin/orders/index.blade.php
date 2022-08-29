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
                    <div class="card-header">
                        {{ trans('cruds.order.title_singular') }} {{ trans('global.list') }}
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable datatable-Order">
                                <thead>
                                    <tr>
                                        <th width="10">

                                        </th>
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
                                            {{ trans('cruds.order.fields.status') }}
                                        </th>
                                        
                                        
                                        <th>
                                            {{ trans('cruds.order.fields.payment_type') }}
                                        </th>
                                        <th>
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $order)
                                        <tr data-entry-id="{{ $order->id }}">
                                            <td>

                                            </td>
                                            <td>
                                                {{ $order->id ?? '' }}
                                            </td>
                                            <td>
                                                {{ $order->order_no ?? '' }}
                                            </td>
                                            <td>
                                                {{ $order->client_name ?? '' }}
                                            </td>
                                            <td>
                                                {{ $order->client_phone ?? '' }}
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
                                                @endif
                                            </td>
                                            
                                            <td>
                                                {{ $order->payment_type ?? '' }}
                                            </td>
                                            <td>
                                                @can('order_show')
                                                    <a class="btn btn-xs btn-primary"
                                                        href="{{ route('admin.orders.show', $order->id) }}">
                                                        {{ trans('global.view') }}
                                                    </a>
                                                @endcan

                                                @can('order_edit')
                                                    <a class="btn btn-xs btn-info"
                                                        href="{{ route('admin.orders.edit', $order->id) }}">
                                                        {{ trans('global.edit') }}
                                                    </a>
                                                @endcan

                                                @can('order_delete')
                                                    <form action="{{ route('admin.orders.destroy', $order->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                                        style="display: inline-block;">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="submit" class="btn btn-xs btn-danger"
                                                            value="{{ trans('global.delete') }}">
                                                    </form>
                                                @endcan

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('order_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.orders.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 10,
            });
            let table = $('.datatable-Order:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
