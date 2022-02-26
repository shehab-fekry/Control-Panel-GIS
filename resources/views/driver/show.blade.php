@extends('driver.layout')

@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="row">
            <div class="continer pt-5">
                <div class="row">
                    <div class="col">
                <div class="card ">
                <div class="card-body bg-warning">
                 <h4>Show  {{$driver->name}}</h4> 
                </div>
              </div></div>
                </div>
            </div>
                <div class="col-md-6 form-group " >email: 
                    <label class="form-label">{{$driver->email}}</label>
                </div>
                <div class="col-md-6 form-group"> licenseNumber: 
                    <label  class="form-label">{{$driver->licenseNumber}}</label>
                </div>
                <div class="col-md-6 form-group"> status: 
                    <label  class="form-label">{{$driver->confirmed}}</label>
                </div>
                <div class="col-md-6 form-group"> region:
                    <label  class="form-label">{{$driver->mobileNumber}}</label>
                </div>
                <div class="col-md-6 form-group"> created_at: 
                    <label  class="form-label">{{$driver->created_at}}</label>
                </div>
                <div class="col-md-6 form-group">updated_at: 
                    <label  class="form-label">{{$driver->updated_at}}</label>
                </div>
                <div class="col-md-6 form-group">
                    {{$driver->details}}
                </div>
                <div class="col-md-6 form-group">
                <a  href="{{route('driver.index') }}" class="btn btn-danger">Return home</a>
                </div>


        </div>
    </div>
</div>

@endsection
