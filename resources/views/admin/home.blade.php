@extends('layouts.admin')
@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-home"></i>
                        {{ __('Home') }}
                    </h3>
                </div>
                <div class="card-body">
                    <p>
                        {{ __('You are logged in!') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
