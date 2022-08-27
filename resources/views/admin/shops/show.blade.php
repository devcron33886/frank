@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.shop.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.shops.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.shop.fields.id') }}
                        </th>
                        <td>
                            {{ $shop->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shop.fields.company_name') }}
                        </th>
                        <td>
                            {{ $shop->company_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shop.fields.phone_number_1') }}
                        </th>
                        <td>
                            {{ $shop->phone_number_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shop.fields.phone_number_2') }}
                        </th>
                        <td>
                            {{ $shop->phone_number_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shop.fields.whatsapp') }}
                        </th>
                        <td>
                            {{ $shop->whatsapp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shop.fields.email_1') }}
                        </th>
                        <td>
                            {{ $shop->email_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shop.fields.email_2') }}
                        </th>
                        <td>
                            {{ $shop->email_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shop.fields.address') }}
                        </th>
                        <td>
                            {{ $shop->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shop.fields.logo') }}
                        </th>
                        <td>
                            @if($shop->logo)
                                <a href="{{ $shop->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $shop->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shop.fields.about') }}
                        </th>
                        <td>
                            {{ $shop->about }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.shops.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection