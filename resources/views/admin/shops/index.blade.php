@extends('layouts.admin')
@section('content')
    
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.shop.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Shop">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.shop.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.shop.fields.company_name') }}
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                {{ trans('cruds.shop.fields.phone_number_2') }}
                            </th>
                            <th>
                                {{ trans('cruds.shop.fields.phone_number_1') }}
                            </th>
                            <th>
                                Action
                            </th>



                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shops as $key => $shop)
                            <tr data-entry-id="{{ $shop->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $shop->id ?? '' }}
                                </td>
                                <td>
                                    {{ $shop->company_name ?? '' }}
                                </td>
                                <td>
                                    {{ $shop->phone_number_1 ?? '' }}
                                </td>
                                <td>
                                    {{ $shop->phone_number_2 ?? '' }}
                                </td>
                                <td>
                                    {{ $shop->whatsapp ?? '' }}
                                </td>


                                <td>
                                    @can('shop_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.shops.show', $shop->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('shop_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.shops.edit', $shop->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('shop_delete')
                                        <form action="{{ route('admin.shops.destroy', $shop->id) }}" method="POST"
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
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('shop_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.shops.massDestroy') }}",
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
                pageLength: 100,
            });
            let table = $('.datatable-Shop:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
