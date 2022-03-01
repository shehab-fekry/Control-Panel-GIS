@extends('vehicle.layout')

@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="row">
            <div class="continer pt-5">
                <div class="row">
                    <div class="col">
                <div class="card ">
                    @if ($message = Session::get('error'))
                    <div class="row">
                      <div class="col">
                      </div>
                      <div class="alert alert-success" role="alert">
                        {{$message}}
                      </div>
                      </div>  
                  @endif
                <div class="card-body ">
                 <h4>edit:  {{$vehicle->licensePlate}}</h4> 
                </div>
              </div></div>
                </div>
            </div>

            <form action="{{route('vehicle.update',$vehicle->id)}}" method="POST" class="row g-3">
                 @csrf
                @method('PUT')
                <div class="col-md-6 form-group">
                    <label class="form-label">licensePlate</label>
                    <input type="text" name="licensePlate" value="{{$vehicle->licensePlate}}" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label  class="form-label">model</label>
                    <input type="text" name="model"  value="{{$vehicle->model}}"  value="" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label  class="form-label">driver_id</label>
                    <input type="text" name="driver_id" value="{{$vehicle->driver_id}}" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label  class="form-label">color</label>
                    <input type="text" name="color" value="{{$vehicle->color}}" class="form-control">
                </div>
                
               
                <div class="col-12 form-group">
                    <button type="submit"  class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
