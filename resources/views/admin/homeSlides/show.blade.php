@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.homeSlide.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.home-slides.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.homeSlide.fields.id') }}
                        </th>
                        <td>
                            {{ $homeSlide->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.homeSlide.fields.header') }}
                        </th>
                        <td>
                            {{ $homeSlide->header }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.homeSlide.fields.description') }}
                        </th>
                        <td>
                            {{ $homeSlide->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.homeSlide.fields.image') }}
                        </th>
                        <td>
                            @if($homeSlide->image)
                                <a href="{{ $homeSlide->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $homeSlide->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.homeSlide.fields.is_active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $homeSlide->is_active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.homeSlide.fields.show_text') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $homeSlide->show_text ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.home-slides.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection