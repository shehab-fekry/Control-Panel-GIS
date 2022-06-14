@extends('layouts.master')

@section('content')

<style>
.update-parent::before{
    content: 'Update Parent';
    background-color: unset;
    color: #384850;
    position: absolute;
    margin-top: -575px;
    left: 80px;
    font-size: 28px;
    font-weight: 900;
    text-shadow: 0px 0px 5px #ccc
}
</style>
<div class="bus-container ">
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="container bg-white update-parent" style="height:575px;">
            <div class="row ">
                <div class="col-md-3 border-right">
                    {{-- <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="{{asset('upload/father/'.$father->image_path)}}"><span class="font-weight-bold">{{$father->name}}</span><span class="text-black-50">{{$father->email}}</span><span> </span></div> --}}
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="{{$father->image_path}}"><span class="font-weight-bold">{{$father->name}}</span><span class="text-black-50">{{$father->email}}</span><span> </span></div>
                </div>
                <div class="col">
                    <div>
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="text-right">Edit information</h4>
                        </div>
                        <form action="{{route('father.update',$father->id)}}" method="POST" class="row g-3" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Name</label><input type="text" name="name" class="form-control" placeholder="name" value="{{$father->name}}"></div>
                            <div class="col-md-6"><label class="labels">email</label><input type="text"  name="email" class="form-control" value="{{$father->email}}" placeholder="example@example.com"></div>
                        </div>
                        {{-- <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">password</label><input type="text" name="password" class="form-control"  value=""></div>
                            <div class="col-md-6"><label class="labels">confirm-password</label><input type="text"  name="password" class="form-control" value="" ></div>
                        </div> --}}
                        <div class="row mt-3">
                            {{-- <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" class="form-control" placeholder="enter phone number" value=""></div>
                            <div class="col-md-12"><label class="labels">Address Line 1</label><input type="text" class="form-control" placeholder="enter address line 1" value=""></div> --}}
                            <div class="col-md-12"><label class="labels">mobileNumber</label><input type="text" class="form-control"  name="mobileNumber"  value="{{$father->mobileNumber}}"></div>
                            <!-- <div class="col-md-12"><label class="labels">Number Of childern</label><input type="text" class="form-control" name="status"  placeholder="enter address line 2" value="{{$father->status}}"></div> -->
                            <div class="col-md-12"><label class="labels">Trip</label>
                                <select class="form-select" aria-label="Default select example" name="trip_id">

                                    @foreach($trips as  $trip )
                                              <option value="{{$trip->id}}"  @if( $trip->id == $father->trip_id) selected @endif >{{$trip->geofence}}</option>
                                    @endforeach

                                  </select>

                                {{-- <input type="text" class="form-control"  name="trip_id"  value="{{$father->trip_id}}"> --}}

                            </div>
                            <div class="col-sm-12">
                            <div class="col-md-6"><label class="labels" style="margin-top: 10px">Status</label></div>
                                <select class="form-select" aria-label="Default select example" name="confirmed">


                                    <option value="1"  @if( $father->confirmed == 1) selected @endif >Confirmed</option>
                                    <option value="0"  @if( $father->confirmed == 0) selected @endif >Not Confirmed</option>


                        </select>
                            </div>
                        </div>
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button update-btn" type="submit">Save Profile</button>
                        </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        </div>
        </div>
<!-- NEWWWWWWWWWWWWWWWWWWWW  -->

<div class="reset-password">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="text-right"></h4>
    </div>

    <div class="container bg-white">
    <form action="{{route('passwordReset',$father->id)}}" method="POST"  enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <input type="hidden" name="fid" value="{{$father->id}}">
                <div class="col-md-12"><label class="labels">Reset Password</label><input type="password"  class="form-control @error('password') is-invalid @enderror" placeholder="Password"  name="password" required autocomplete="new-password" /></div>
                  @error('password')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                <div class="col-md-12"><label class="labels"  for="password-confirm">Confirm Password</label><input  type="password" id="password-confirm" placeholder="Reset Password" class="form-control"  name="password_confirmation"  required autocomplete="new-password"/></div>
            </div>
            <div class="my-5 text-center"><input class="btn btn-primary profile-button update-btn" type="submit" value="Reset Password"/>

        </form>
    </div>
</div>
</div>
</div>
</div>



  @if ($message= session('error'))
  @foreach($message as $messages)
    <div class="alertr hide">
    <span class='fas fa-exclamation-triangle'></span>
    <span class="msg">{{$messages}}</span>
    <div class="close-btn">
    <span class="fas fa-times"></span>
    </div>
    </div>
@endforeach
@endif
@endsection
