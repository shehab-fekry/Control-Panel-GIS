@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}
                    <a type="button" href="{{route('father.index')}}" class="btn btn-primary">Father</a>
                    <a type="button" class="btn btn-secondary">Secondary</a>
                    <a type="button" class="btn btn-success">Success</a>
                    <a type="button" class="btn btn-danger">Danger</a>
                    <a type="button" class="btn btn-warning">Warning</a>
                    <a type="button" class="btn btn-info">Info</a>
                    <a type="button" class="btn btn-light">Light</a>
                    <a type="button" class="btn btn-dark">Dark</a>

                    <a type="button" class="btn btn-link">Link</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
