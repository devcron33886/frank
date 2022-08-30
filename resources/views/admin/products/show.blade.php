@extends('layouts.admin')
@section('content')
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
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.show') }} {{ trans('cruds.product.title') }}
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('admin.products.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.product.fields.id') }}
                                        </th>
                                        <td>
                                            {{ $product->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.product.fields.category') }}
                                        </th>
                                        <td>
                                            {{ $product->category->name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.product.fields.name') }}
                                        </th>
                                        <td>
                                            {{ $product->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.product.fields.qty') }}
                                        </th>
                                        <td>
                                            {{ $product->qty }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.product.fields.price') }}
                                        </th>
                                        <td>
                                            {{ $product->price }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.product.fields.measure') }}
                                        </th>
                                        <td>
                                            {{ $product->measure }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.product.fields.min_stock') }}
                                        </th>
                                        <td>
                                            {{ $product->min_stock }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.product.fields.status') }}
                                        </th>
                                        <td>
                                            {{ App\Models\Product::STATUS_SELECT[$product->status] ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.product.fields.description') }}
                                        </th>
                                        <td>
                                            {{ $product->description }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.product.fields.image') }}
                                        </th>
                                        <td>
                                            @if ($product->image)
                                                <a href="{{ $product->image->getUrl() }}" target="_blank"
                                                    style="display: inline-block">
                                                    <img src="{{ $product->image->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.product.fields.discount') }}
                                        </th>
                                        <td>
                                            {{ $product->discount }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('admin.products.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
