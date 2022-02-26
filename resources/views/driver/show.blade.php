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
                <div class="col-md-6 form-group " >mobileNumber: 
                    <label class="form-label">{{$father->mobileNumber}}</label>
                </div>
                <div class="col-md-6 form-group"> trip_id: 
                    <label  class="form-label">{{$father->trip_id}}</label>
                </div>
                <div class="col-md-6 form-group"> status: 
                    <label  class="form-label">{{$father->status}}</label>
                </div>
                <div class="col-md-6 form-group"> region:
                    <label  class="form-label">{{$father->region}}</label>
                </div>
                <div class="col-md-6 form-group"> lng: 
                    <label  class="form-label">{{$father->lng}}</label>
                </div>
                <div class="col-md-6 form-group"> lit: 
                    <label  class="form-label">{{$father->lit}}</label>
                </div>
                <div class="col-md-6 form-group"> created_at: 
                    <label  class="form-label">{{$father->created_at}}</label>
                </div>
                <div class="col-md-6 form-group">updated_at: 
                    <label  class="form-label">{{$father->updated_at}}</label>
                </div>
                <div class="col-md-6 form-group">
                    {{$father->details}}
                </div>
                <div class="col-md-6 form-group">
                <a  href="{{route('father.index') }}" class="btn btn-danger">Return home</a>
                </div>

        </div>
    </div>
</div>

@endsection
