@extends('vehicle.layout')

@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="row">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">Add new vehicle
                            </h3>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add new vehicle</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            {{-- <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Add new father</h5>
                    <form action="{{route('father.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="name" class="">{{ __('Name') }}
                                    </label>
                                    <input name="name" id="name" placeholder="Enter Father Name" type="text" class="
                                form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                                        required autocomplete="name" autofocus>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="email" class="">{{ __('Email Address') }}</label>
                                    <input name="email" id="email" placeholder="with a placeholder" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="password"
                                        class="">{{ __('Password') }}
                                    </label>
                                    <input name="password" id="password"
                                        placeholder="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror


                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group"><label for="password-confirm"
                                        class="">{{ __('password-confirm') }}</label><input name="password-confirm" id="password-confirm"
                                        placeholder="password " type="password"
                                        class="form-control" name="password_confirmation"
                                        required autocomplete="new-password">

                                </div>
                            </div>
                        </div>

                        <div class="position-relative form-group"><label for="m_number"
                            class="">{{ __('m_number') }}</label><input name="m_number" id="password"
                            placeholder="mobile Number" type="m_number"
                            class="form-control @error('m_number') is-invalid @enderror" name="m_number"
                            required autocomplete="m_number">
                    </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="position-relative form-group"><label for="trip_id"
                                    class="">{{ __('Trip id') }}</label><input name="trip_id" id="trip_id"
                                    placeholder="trip_id " type="text"
                                    class="form-control" name="trip_id"
                                    required autocomplete="trip_id">

                            </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group"><label for="status"
                                    class="">{{ __('status') }}</label><input name="status" id="status"
                                    placeholder="status" type="text"
                                    class="form-control" name="status"
                                    required autocomplete="status">

                            </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group"><label for="region"
                                    class="">{{ __('region') }}</label><input name="region" id="region"
                                    placeholder="region" type="text"
                                    class="form-control" name="region"
                                    required autocomplete="region">

                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="position-relative form-group"><label for="lng"
                                    class="">{{ __('lng ') }}</label><input name="lng" id="lng"
                                    placeholder="lng " type="text"
                                    class="form-control" name="lng"
                                    required autocomplete="lng">

                            </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="position-relative form-group"><label for="lit"
                                    class="">{{ __('lit') }}</label><input name="lit" id="lit"
                                    placeholder="lit" type="text"
                                    class="form-control" name="lit"
                                    required autocomplete="lit">

                            </div>
                            </div>
                        </div>
                        <button class="mt-2 btn btn-primary">ADD</button>
                    </form>
                </div>
            </div> --}}
            
            <form action="{{route('vehicle.store')}}" method="POST" class="row g-3">
            @csrf

            <div class="row mb-3">
                <label for="licensePlate" class="col-md-4 col-form-label text-md-end">{{ __('licensePlate') }}</label>

                <div class="col-md-6">
                    <input id="licensePlate" type="text" class="form-control @error('licensePlate') is-invalid @enderror" name="licensePlate"
                        value="{{ old('licensePlate') }}" required autocomplete="licensePlate" autofocus>
                </div>
            </div>

            <div class="row mb-3">
                <label for="model" class="col-md-4 col-form-label text-md-end">{{ __('model') }}</label>

                <div class="col-md-6">
                    <input id="model" type="text" class="form-control @error('model') is-invalid @enderror"
                        name="model" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="driver_id" class="col-md-4 col-form-label text-md-end">{{ __('driver_id') }}</label>

                <div class="col-md-6">
                    <input id="driver_id" type="text" class="form-control @error('driver_id') is-invalid @enderror"
                        name="driver_id" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="color" class="col-md-4 col-form-label text-md-end">{{ __('color') }}</label>

                <div class="col-md-6">
                    <input id="color" type="text" class="form-control @error('color') is-invalid @enderror"
                        name="color" required>
                </div>
            </div>

            <div class="col-12 form-group">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
