@extends('driver.layout')

@section('content')
<link rel="stylesheet" href="{{ asset("css/Findex.css") }}">
            <div class="row">
                @foreach($driver as $drivers )
                <div class="col-md-4">
                

                    <div class="card user-card" >  
                        <div class="card-header">
                            <a type="submit" class="btn btn-light" href="{{route('driver.show',$drivers->id)}}">Profile</a>
                        </div>
                        <div class="card-block">
                            <div class="form-check form-switch" style="margin-top: -25px; margin-bottom: 16px;"> <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked> </div>
                            <div class="user-image">
                                <img src="upload/driver/{{$drivers->image_path}}" class="img-radius" alt="User-Profile-Image">
                            </div>
                            <h6 class="f-w-600 m-t-25 m-b-10"> {{$drivers->name}}</h6>
                            {{-- <p class="text-muted">Active | Male | Born 23.05.1992</p> --}}
                            <hr>
                            <p class="text-muted m-t-15">Mobile Number: {{$drivers->mobileNumber}}</p>
                            <p class="text-muted m-t-15">Email: {{$drivers->email}}</p>
                            
                            {{-- <p class="m-t-15 text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> --}}
                            <hr>
                            <div class="row">

                            <div class="col">
                                <a href="{{route('driver.edit',$drivers->id)}}" type="submit" class="btn btn-primary">UPDATE</a>
                             </div>

                                <div class="col">
                                <button type="submit" class="btn btn-primary">ASSIGN</button>
                             </div>

                            <div class="col">
                                <form action="{{route('driver.destroy',$drivers->id)}}" method="POST">
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
            @if (session('success'))
            <div class="alert alert-danger" role="alert">
           {{ session('success') }}
           </div>
            @endif
            </div>
        
@endsection
