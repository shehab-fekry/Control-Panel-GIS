@extends('vehicle.layout')

@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="row">
            <div class="continer pt-5">
                <div class="row">
                    <div class="col">
                <div class="card ">
                <div class="card-body bg-warning">
                 <h4>licensePlate:  {{$vehicle->licensePlate}}</h4> 
                </div>
              </div></div>
                </div>
            </div>
                <div class="col-md-6 form-group"> model: 
                    <label  class="form-label">{{$vehicle->model}}</label>
                </div>
                <div class="col-md-6 form-group"> driver_id: 
                    <label  class="form-label">{{$vehicle->driver_id}}</label>
                </div>
                <div class="col-md-6 form-group"> color: 
                    <label  class="form-label">{{$vehicle->color}}</label>
                </div>
                <div class="col-md-6 form-group"> created_at: 
                    <label  class="form-label">{{$vehicle->created_at}}</label>
                </div>
                <div class="col-md-6 form-group">updated_at: 
                    <label  class="form-label">{{$vehicle->updated_at}}</label>
                </div>
                <div class="col-md-6 form-group">
                <a  href="{{route('vehicle.index') }}" class="btn btn-danger">Return home</a>
                </div>
        </div>
    </div>
</div>

@endsection
