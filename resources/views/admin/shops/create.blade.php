@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.shop.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.shops.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="company_name">{{ trans('cruds.shop.fields.company_name') }}</label>
                <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text" name="company_name" id="company_name" value="{{ old('company_name', '') }}">
                @if($errors->has('company_name'))
                    <span class="text-danger">{{ $errors->first('company_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.company_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone_number_1">{{ trans('cruds.shop.fields.phone_number_1') }}</label>
                <input class="form-control {{ $errors->has('phone_number_1') ? 'is-invalid' : '' }}" type="text" name="phone_number_1" id="phone_number_1" value="{{ old('phone_number_1', '') }}">
                @if($errors->has('phone_number_1'))
                    <span class="text-danger">{{ $errors->first('phone_number_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.phone_number_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone_number_2">{{ trans('cruds.shop.fields.phone_number_2') }}</label>
                <input class="form-control {{ $errors->has('phone_number_2') ? 'is-invalid' : '' }}" type="text" name="phone_number_2" id="phone_number_2" value="{{ old('phone_number_2', '') }}" required>
                @if($errors->has('phone_number_2'))
                    <span class="text-danger">{{ $errors->first('phone_number_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.phone_number_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="whatsapp">{{ trans('cruds.shop.fields.whatsapp') }}</label>
                <input class="form-control {{ $errors->has('whatsapp') ? 'is-invalid' : '' }}" type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', '') }}" required>
                @if($errors->has('whatsapp'))
                    <span class="text-danger">{{ $errors->first('whatsapp') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.whatsapp_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email_1">{{ trans('cruds.shop.fields.email_1') }}</label>
                <input class="form-control {{ $errors->has('email_1') ? 'is-invalid' : '' }}" type="email" name="email_1" id="email_1" value="{{ old('email_1') }}" required>
                @if($errors->has('email_1'))
                    <span class="text-danger">{{ $errors->first('email_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.email_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email_2">{{ trans('cruds.shop.fields.email_2') }}</label>
                <textarea class="form-control {{ $errors->has('email_2') ? 'is-invalid' : '' }}" name="email_2" id="email_2">{{ old('email_2') }}</textarea>
                @if($errors->has('email_2'))
                    <span class="text-danger">{{ $errors->first('email_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.email_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.shop.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="logo">{{ trans('cruds.shop.fields.logo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}" id="logo-dropzone">
                </div>
                @if($errors->has('logo'))
                    <span class="text-danger">{{ $errors->first('logo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.logo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="about">{{ trans('cruds.shop.fields.about') }}</label>
                <textarea class="form-control {{ $errors->has('about') ? 'is-invalid' : '' }}" name="about" id="about">{{ old('about') }}</textarea>
                @if($errors->has('about'))
                    <span class="text-danger">{{ $errors->first('about') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.about_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.logoDropzone = {
    url: '{{ route('admin.shops.storeMedia') }}',
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
    success: function (file, response) {
      $('form').find('input[name="logo"]').remove()
      $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($shop) && $shop->logo)
      var file = {!! json_encode($shop->logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
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