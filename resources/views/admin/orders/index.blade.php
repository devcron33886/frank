@extends('layouts.admin')
@section('content')
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
                                {{ trans('cruds.order.fields.shipping_amount') }}
                            </th>

                            <th>
                                {{ trans('cruds.order.fields.payment_type') }}
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $key => $order)
                            <tr data-entry-id="{{ $order->id }}">
                                <td>

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


                                <td>
                                    {{ $order->shipping_amount ?? '' }}
                                </td>

                                <td>
                                    {{ $order->payment_type ?? '' }}
                                </td>
                                <td>


                                    @can('order_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.orders.edit', $order->id) }}">
                                            Details
                                        </a>
                                    @endcan



                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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
