@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.order.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.orders.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="order_no">{{ trans('cruds.order.fields.order_no') }}</label>
                <input class="form-control {{ $errors->has('order_no') ? 'is-invalid' : '' }}" type="text" name="order_no" id="order_no" value="{{ old('order_no', '') }}" required>
                @if($errors->has('order_no'))
                    <span class="text-danger">{{ $errors->first('order_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.order_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="client_name">{{ trans('cruds.order.fields.client_name') }}</label>
                <input class="form-control {{ $errors->has('client_name') ? 'is-invalid' : '' }}" type="text" name="client_name" id="client_name" value="{{ old('client_name', '') }}" required>
                @if($errors->has('client_name'))
                    <span class="text-danger">{{ $errors->first('client_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.client_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="client_phone">{{ trans('cruds.order.fields.client_phone') }}</label>
                <input class="form-control {{ $errors->has('client_phone') ? 'is-invalid' : '' }}" type="text" name="client_phone" id="client_phone" value="{{ old('client_phone', '') }}" required>
                @if($errors->has('client_phone'))
                    <span class="text-danger">{{ $errors->first('client_phone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.client_phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.order.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.order.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Order::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', 'Prnding') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="shipping_address">{{ trans('cruds.order.fields.shipping_address') }}</label>
                <input class="form-control {{ $errors->has('shipping_address') ? 'is-invalid' : '' }}" type="text" name="shipping_address" id="shipping_address" value="{{ old('shipping_address', '') }}" required>
                @if($errors->has('shipping_address'))
                    <span class="text-danger">{{ $errors->first('shipping_address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.shipping_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="notes">{{ trans('cruds.order.fields.notes') }}</label>
                <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes" required>{{ old('notes') }}</textarea>
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="shipping_amount">{{ trans('cruds.order.fields.shipping_amount') }}</label>
                <input class="form-control {{ $errors->has('shipping_amount') ? 'is-invalid' : '' }}" type="number" name="shipping_amount" id="shipping_amount" value="{{ old('shipping_amount', '0') }}" step="1">
                @if($errors->has('shipping_amount'))
                    <span class="text-danger">{{ $errors->first('shipping_amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.shipping_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="updated_by_id">{{ trans('cruds.order.fields.updated_by') }}</label>
                <select class="form-control select2 {{ $errors->has('updated_by') ? 'is-invalid' : '' }}" name="updated_by_id" id="updated_by_id">
                    @foreach($updated_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('updated_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('updated_by'))
                    <span class="text-danger">{{ $errors->first('updated_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.updated_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="payment_type">{{ trans('cruds.order.fields.payment_type') }}</label>
                <input class="form-control {{ $errors->has('payment_type') ? 'is-invalid' : '' }}" type="text" name="payment_type" id="payment_type" value="{{ old('payment_type', 'Cash') }}">
                @if($errors->has('payment_type'))
                    <span class="text-danger">{{ $errors->first('payment_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.payment_type_helper') }}</span>
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