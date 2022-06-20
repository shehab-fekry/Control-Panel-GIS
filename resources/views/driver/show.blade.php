@extends('layouts.master')

@section('content')

    <div class="bus-container">
      <nav style="--bs-breadcrumb-divider: '>'; position: relative; top: -25px;" aria-label="breadcrumb" class=" mb-4 ">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('driver.index') }}">Drivers</a></li>
          <li class="breadcrumb-item active" aria-current="page">User Profile </li>
        </ol>
      </nav>
{{-- <section class="vh-100 gradient-custom" style="border-radius: 20px; border: none; overflow: scroll;">    --}}
    <div   style="background: url(k.jfif); background-size: cover;">
      <div class="row justify-content-center align-items-center"  >
        {{-- <div class="col-12 col-lg-9 col-xl-7"> --}}
          {{-- <div class="card shadow-2-strong card-registration" style="border-radius: 5px;margin-bottom: 20px; border: none;"> --}}
            <div class="headingProfileDriver card-body p-4 p-md-5" style="background-color:#fafafa; box-shadow: 0px 0px 5px #ccc; border-radius: 20px; border: none; ">




      <div class="row" >
        <div class="col-lg ">
          <div class="card mb-4"style="background-color: whitesmoke;">
            <div class="card-body text-center" >
              {{-- <img src="{{asset('upload/driver/'.$driver->image_path)}}" alt="avatar" class="rounded-circle img-fluid" style="width: 125px; hieght: 125px"> --}}
              <img src="{{$driver->image_path}}" alt="avatar" class="rounded-circle img-fluid" style="width: 125px; hieght: 125px">
              <h5 class="my-3">Captain: {{$driver->name}}</h5>
              <p class="text-muted mb-1">Driver</p>

            </div>
          </div>

        </div>
        <div class="col-lg-8">
          <div class="card mb-4"style="background-color: whitesmoke;">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0"> Name</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$driver->name}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$driver->email}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Phone</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$driver->mobileNumber}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">License Number</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$driver->licenseNumber}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">School</p>
                </div>
                <div class="col-sm-9">
                  <a type="submit" class="text-muted mb-0" href="{{route('school.index',$schools->id)}}">{{ $schools->name }}  </a>
                  {{-- <p class=""></p> --}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Trip</p>
                </div>
                <div class="col-sm-9">
                  @foreach($trips as  $trip )
                  @if( $trip->id == $driver->trip_id)
                  <a href="{{route('trip.show',$trip->id)}}" class="text-muted mb-0">{{$trip->geofence}}
                  @endif
                  @endforeach
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
    </div>
      @endsection
