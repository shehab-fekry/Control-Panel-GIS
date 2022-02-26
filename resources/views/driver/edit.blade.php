@extends('driver.layout')

@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="row">
            <div class="continer pt-5">
                <div class="row">
                    <div class="col">
                <div class="card ">
                <div class="card-body ">
                 <h4>edit:  {{$father->name}}</h4> 
                </div>
              </div></div>
                </div>
            </div>

            <form action="{{route('father.update',$father->id)}}" method="POST" class="row g-3">
                 @csrf
                @method('PUT')
                <div class="col-md-6 form-group">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{$father->name}}" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label  class="form-label">password</label>
                    <input type="password" name="password"  value="{{$father->password}}"  value="" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label  class="form-label">mobileNumber</label>
                    <input type="text" name="mobileNumber" value="{{$father->mobileNumber}}" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label  class="form-label">trip_id</label>
                    <input type="text" name="trip_id" value="{{$father->trip_id}}" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label  class="form-label">status</label>
                    <input type="text" name="status" value="{{$father->status}}" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label  class="form-label">region</label>
                    <input type="text" name="region" value="{{$father->region}}" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label  class="form-label">lng</label>
                    <input type="text" name="lng" value="{{$father->lng}}" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label  class="form-label">lit</label>
                    <input type="text" name="lit" value="{{$father->lit}}" class="form-control">
                </div>
               
                <div class="col-12 form-group">
                    <button type="submit"  class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
