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
                            <li class="breadcrumb-item active">Events</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        {{ trans('global.edit') }} {{ trans('cruds.event.title_singular') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.events.update', [$event->id]) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="name">{{ trans('cruds.event.fields.name') }}</label>
                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                                    name="name" id="name" value="{{ old('name', $event->name) }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.event.fields.name_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required"
                                    for="description">{{ trans('cruds.event.fields.description') }}</label>
                                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                                    id="description" required>{{ old('description', $event->description) }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.event.fields.description_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <div class="form-check {{ $errors->has('active') ? 'is-invalid' : '' }}">
                                    <input type="hidden" name="active" value="0">
                                    <input class="form-check-input" type="checkbox" name="active" id="active"
                                        value="1" {{ $event->active || old('active', 0) === 1 ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="active">{{ trans('cruds.event.fields.active') }}</label>
                                </div>
                                @if ($errors->has('active'))
                                    <span class="text-danger">{{ $errors->first('active') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.event.fields.active_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="date">{{ trans('cruds.event.fields.date') }}</label>
                                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}"
                                    type="text" name="date" id="date" value="{{ old('date', $event->date) }}">
                                @if ($errors->has('date'))
                                    <span class="text-danger">{{ $errors->first('date') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.event.fields.date_helper') }}</span>
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
