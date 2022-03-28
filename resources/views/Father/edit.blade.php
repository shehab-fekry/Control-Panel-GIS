@extends('layouts.master')

@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="container bg-white">
            <div class="row ">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="{{asset('upload/father/'.$father->image_path)}}"><span class="font-weight-bold">{{$father->name}}</span><span class="text-black-50">{{$father->email}}</span><span> </span></div>
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
                            <div class="col-md-12"><label class="labels">Number Of childern</label><input type="text" class="form-control" name="status"  placeholder="enter address line 2" value="{{$father->status}}"></div>
                            <div class="col-md-12"><label class="labels">Trip</label><input type="text" class="form-control"  name="trip_id"  value="{{$father->trip_id}}"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-4 d-flex align-items-center">
              
                              <div class="form-outline datepicker w-100">
                                <label for="image"  class="form-label">Photo</label>
          
                                <input
                                  type="file" name="image"
                                  class="form-control form-control-lg"
                                  id="image"
                                />
                              </div>
            
                            </div>
      
                           </div>
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button>
                        </form>
                        </div>
                    </div>
               
                </div>
               
            </div>
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
