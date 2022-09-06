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
                        {{ trans('global.edit') }} {{ trans('cruds.product.title_singular') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.products.update', [$product->id]) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label class="required"
                                    for="category_id">{{ trans('cruds.product.fields.category') }}</label>
                                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}"
                                    name="category_id" id="category_id" required>
                                    @foreach ($categories as $id => $entry)
                                        <option value="{{ $id }}"
                                            {{ (old('category_id') ? old('category_id') : $product->category->id ?? '') == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category'))
                                    <span class="text-danger">{{ $errors->first('category') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required" for="name">{{ trans('cruds.product.fields.name') }}</label>
                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                                    name="name" id="name" value="{{ old('name', $product->name) }}" required>
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required" for="qty">{{ trans('cruds.product.fields.qty') }}</label>
                                <input class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}" type="text"
                                    name="qty" id="qty" value="{{ old('qty', $product->qty) }}" required>
                                @if ($errors->has('qty'))
                                    <span class="text-danger">{{ $errors->first('qty') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.qty_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required" for="price">{{ trans('cruds.product.fields.price') }}</label>
                                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number"
                                    name="price" id="price" value="{{ old('price', $product->price) }}"
                                    step="1" required>
                                @if ($errors->has('price'))
                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.price_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required" for="measure">{{ trans('cruds.product.fields.measure') }}</label>
                                <input class="form-control {{ $errors->has('measure') ? 'is-invalid' : '' }}"
                                    type="text" name="measure" id="measure"
                                    value="{{ old('measure', $product->measure) }}" required>
                                @if ($errors->has('measure'))
                                    <span class="text-danger">{{ $errors->first('measure') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.measure_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="min_stock">{{ trans('cruds.product.fields.min_stock') }}</label>
                                <input class="form-control {{ $errors->has('minStock') ? 'is-invalid' : '' }}"
                                    type="text" name="minStock" id="minStock"
                                    value="{{ old('minStock', $product->minStock) }}">
                                @if ($errors->has('minStock'))
                                    <span class="text-danger">{{ $errors->first('minStock') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.min_stock_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label>{{ trans('cruds.product.fields.status') }}</label>
                                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}"
                                    name="status" id="status">
                                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                                        {{ trans('global.pleaseSelect') }}</option>
                                    @foreach (App\Models\Product::STATUS_SELECT as $key => $label)
                                        <option value="{{ $key }}"
                                            {{ old('status', $product->status) === (string) $key ? 'selected' : '' }}>
                                            {{ $label }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('status'))
                                    <span class="text-danger">{{ $errors->first('status') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.status_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="description">{{ trans('cruds.product.fields.description') }}</label>
                                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                    id="description">{{ old('description', $product->description) }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.description_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="image">{{ trans('cruds.product.fields.image') }}</label>
                                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}"
                                    id="image-dropzone">
                                </div>
                                @if ($errors->has('image'))
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.image_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="discount">{{ trans('cruds.product.fields.discount') }}</label>
                                <input class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}"
                                    type="number" name="discount" id="discount"
                                    value="{{ old('discount', $product->discount) }}" step="1">
                                @if ($errors->has('discount'))
                                    <span class="text-danger">{{ $errors->first('discount') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.product.fields.discount_helper') }}</span>
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

@section('scripts')
    <script>
        Dropzone.options.imageDropzone = {
            url: '{{ route('admin.products.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="image"]').remove()
                $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="image"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($product) && $product->image)
                    var file = {!! json_encode($product->image) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
@endsection
