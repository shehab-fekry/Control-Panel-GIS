@extends('layouts.master')

@section('content')

<link rel="stylesheet" href="{{ asset("css/Findex.css") }}">
<div class="profile-page">

            <div class="row">
                @foreach($fathers as $parent )
                <div class="col-md-4">
               

                    <div class="card user-card" >  
                        <div class="card-header">
                            <a type="submit" class="btn btn-light" href="{{route('father.show',$parent->id)}}">Profile</a>
                        </div>
                        <div class="card-block">
                            <div class="form-check form-switch" style="margin-top: -25px; margin-bottom: 16px;"> <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked> </div>
                            <div class="user-image">
                                <img src="upload/father/{{$parent->image_path}}" class="img-radius" alt="User-Profile-Image">
                            </div>
                            <h6 class="f-w-600 m-t-25 m-b-10">{{$parent->name}}</h6>
                            {{-- <p class="text-muted">Active | Male | Born 23.05.1992</p> --}}
                            <hr>
                            <p class="text-muted m-t-15">Mobile Number: {{$parent->mobileNumber}}</p>
                            <p class="text-muted m-t-15">Email: {{$parent->email}}</p>
                            
                            {{-- <p class="m-t-15 text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> --}}
                            <hr>
                            <div class="row">

                            <div class="col">
                                <a href="{{route('father.edit',$parent->id)}}" type="submit" class="btn btn-primary">UPDATE</a>
                             </div>

                                <div class="col">
                                <button type="submit" class="btn btn-primary">ASSIGN</button>
                             </div>

                            <div class="col">
                                <form action="{{route('father.destroy',$parent->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">DELETE</button> 
                                </form> 
                             </div>
                             </div>
                        </div>
                    </div>
            </div>
            @endforeach

            </div>
            <!-- <button>Show Alert</button> -->
      <div class="alert hide">
         <span class="fas fa-exclamation-circle"></span>
         <span class="msg">Warning: This is a warning alert!</span>
         <div class="close-btn">
            <span class="fas fa-times"></span>
         </div>
      </div>
      <script>
        //  $('button').click(function(){
        //    $('.alert').addClass("show");
        //    $('.alert').removeClass("hide");
        //    $('.alert').addClass("showAlert");
         document.addEventListener("DOMContentLoaded", function() {
          $('.alert').addClass("show");
          $('.alert').removeClass("hide");
          $('.alert').addClass("showAlert");
           setTimeout(function(){
             $('.alert').removeClass("show");
             $('.alert').addClass("hide");
           },5000);
         });
         $('.close-btn').click(function(){
           $('.alert').removeClass("show");
           $('.alert').addClass("hide");
         });
      </script>
        
</div>  
@endsection
