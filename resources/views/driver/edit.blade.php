@extends('driver.layout')

@section('content')

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="row">
            @if ($message = Session::get('error'))
    <div class="row">
      <div class="col">
      </div>
      <div class="alert alert-success" role="alert">
        {{$message}}
      </div>
      </div>  
  @endif
            <div class="continer pt-5">
                <div class="row">
                    <div class="col">
                <div class="card ">
                <div class="card-body ">
                 <h4>edit:  {{$driver->name}}</h4> 
                </div>
              </div></div>
                </div>
            </div>

            <form action="{{route('driver.update',$driver->id)}}" method="POST" class="row g-3">
                 @csrf
                @method('PUT')
                <div class="col-md-6 form-group">
                    <label class="form-label">name</label>
                    <input type="text" name="name" value="{{$driver->name}}" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label class="form-label">email</label>
                    <input type="text" name="email" value="{{$driver->email}}" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label  class="form-label">password</label>
                    <input type="password" name="password"  value="{{$driver->password}}"  value="" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label  class="form-label">licenseNumber</label>
                    <input type="text" name="licenseNumber" value="{{$driver->licenseNumber}}" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label  class="form-label">mobileNumber</label>
                    <input type="text" name="mobileNumber" value="{{$driver->mobileNumber}}" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label  class="form-label">confirmed</label>
                    <input type="text" name="confirmed" value="{{$driver->confirmed}}" class="form-control">
                </div>
                    <button type="submit"  class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
