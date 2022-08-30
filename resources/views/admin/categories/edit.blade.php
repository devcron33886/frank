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
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.edit') }} {{ trans('cruds.category.title_singular') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.categories.update', [$category->id]) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label class="required" for="name">{{ trans('cruds.category.fields.name') }}</label>
                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                                    name="name" id="name" value="{{ old('name', $category->name) }}" required>
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.category.fields.name_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label>{{ trans('cruds.category.fields.status') }}</label>
                                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}"
                                    name="status" id="status">
                                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                                        {{ trans('global.pleaseSelect') }}</option>
                                    @foreach (App\Models\Category::STATUS_SELECT as $key => $label)
                                        <option value="{{ $key }}"
                                            {{ old('status', $category->status) === (string) $key ? 'selected' : '' }}>
                                            {{ $label }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('status'))
                                    <span class="text-danger">{{ $errors->first('status') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.category.fields.status_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger" type="submit">
                                    {{ trans('global.save') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
