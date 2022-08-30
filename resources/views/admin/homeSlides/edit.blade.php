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
                            <li class="breadcrumb-item active">Home Slides</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        {{ trans('global.edit') }} {{ trans('cruds.homeSlide.title_singular') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.home-slides.update', [$homeSlide->id]) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="header">{{ trans('cruds.homeSlide.fields.header') }}</label>
                                <input class="form-control {{ $errors->has('header') ? 'is-invalid' : '' }}" type="text"
                                    name="header" id="header" value="{{ old('header', $homeSlide->header) }}">
                                @if ($errors->has('header'))
                                    <span class="text-danger">{{ $errors->first('header') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.homeSlide.fields.header_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="description">{{ trans('cruds.homeSlide.fields.description') }}</label>
                                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                    id="description">{{ old('description', $homeSlide->description) }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.homeSlide.fields.description_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required" for="image">{{ trans('cruds.homeSlide.fields.image') }}</label>
                                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}"
                                    id="image-dropzone">
                                </div>
                                @if ($errors->has('image'))
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.homeSlide.fields.image_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <div class="form-check {{ $errors->has('is_active') ? 'is-invalid' : '' }}">
                                    <input type="hidden" name="is_active" value="0">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                        value="1"
                                        {{ $homeSlide->is_active || old('is_active', 0) === 1 ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="is_active">{{ trans('cruds.homeSlide.fields.is_active') }}</label>
                                </div>
                                @if ($errors->has('is_active'))
                                    <span class="text-danger">{{ $errors->first('is_active') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.homeSlide.fields.is_active_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <div class="form-check {{ $errors->has('show_text') ? 'is-invalid' : '' }}">
                                    <input type="hidden" name="show_text" value="0">
                                    <input class="form-check-input" type="checkbox" name="show_text" id="show_text"
                                        value="1"
                                        {{ $homeSlide->show_text || old('show_text', 0) === 1 ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="show_text">{{ trans('cruds.homeSlide.fields.show_text') }}</label>
                                </div>
                                @if ($errors->has('show_text'))
                                    <span class="text-danger">{{ $errors->first('show_text') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.homeSlide.fields.show_text_helper') }}</span>
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
            url: '{{ route('admin.home-slides.storeMedia') }}',
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
                @if (isset($homeSlide) && $homeSlide->image)
                    var file = {!! json_encode($homeSlide->image) !!}
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
