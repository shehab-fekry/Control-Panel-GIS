@extends('driver.layout')

@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class=" mb-4 ">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('driver.index') }}">Drivers</a></li>
              <li class="breadcrumb-item active" aria-current="page">Update Driver </li>
            </ol>
          </nav>
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="text-right headingUpdateDriver"></h4>
        </div>
        <div class="container bg-white">
            
            <div class="row  mt-5">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">{{$driver->name}}</span><span class="text-black-50">{{$driver->email}}</span><span> </span></div>
                </div>
                <div class="col">
                        
                        <form action="{{route('driver.update',$driver->id)}}" method="POST" class="row g-3">
                            @csrf
                            @method('PUT')

                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Name</label><input type="text" name="name" class="form-control" placeholder="name" value="{{$driver->name}}"></div>
                            <div class="col-md-6"><label class="labels">License Number</label><input type="text"  name="licenseNumber" class="form-control" value="{{$driver->licenseNumber}}" placeholder="example@example.com"></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Mobile</label><input type="text" name="mobileNumber" class="form-control"  value="{{$driver->mobileNumber}}"></div>
                            <div class="col-md-6"><label class="labels">School</label><input type="text"  name="school_id" class="form-control" value="{{$driver->school_id}}" ></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Email</label><input type="text" name="email" class="form-control"  value="{{$driver->email}}"></div>
                            <div class="col-md-6"><label class="labels">Trip</label><input type="text"  name="trip_id" class="form-control" value="{{$driver->trip_id}}" ></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Password</label><input type="Password" name="password" class="form-control"  value=""></div>
                            <div class="col-md-6"><label class="labels">Confirm Password</label><input type="Password"  name="password" class="form-control" value="" ></div>
                        </div>
                       
                        <div class="my-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button>
                        </form>
                        </div>
                    
               
                </div>
               
            </div>
        </div>
        </div>
        </div>


@endsection
