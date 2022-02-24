@extends('Father.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="continer pt-5">
                <div class="row">
                    <div class="col">
                <div class="card ">
                <div class="card-body bg-info ">
                  Add New Father.
                </div>
              </div></div>
                </div>
            </div>
<div class="my-5"></div>
            <form action="{{route('father.store')}}" method="POST" class="row g-3">
                @csrf
             
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="m_number" class="col-md-4 col-form-label text-md-end">{{ __('m_number') }}</label>

                    <div class="col-md-6">
                        <input id="m_number" type="text" class="form-control @error('m_number') is-invalid @enderror" name="m_number" required >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="trip_id" class="col-md-4 col-form-label text-md-end">{{ __('trip id') }}</label>

                    <div class="col-md-6">
                        <input id="trip_id" type="text" class="form-control @error('trip_id') is-invalid @enderror" name="trip_id" required >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('status') }}</label>

                    <div class="col-md-6">
                        <input id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status" required >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="region" class="col-md-4 col-form-label text-md-end">{{ __('region') }}</label>

                    <div class="col-md-6">
                        <input id="region" type="text" class="form-control @error('region') is-invalid @enderror" name="region"  >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="lng" class="col-md-4 col-form-label text-md-end">{{ __('lng') }}</label>

                    <div class="col-md-6">
                        <input id="lng" type="text" class="form-control @error('lng') is-invalid @enderror" name="lng"  >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="lit" class="col-md-4 col-form-label text-md-end">{{ __('lit') }}</label>

                    <div class="col-md-6">
                        <input id="lit" type="text" class="form-control @error('lit') is-invalid @enderror" name="lit"  >
                    </div>
                </div>

                
                <div class="col-12 form-group">
                    <button type="submit"  class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
