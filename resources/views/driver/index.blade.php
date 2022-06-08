@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset("css/Findex.css") }}">

<div class="bus-container">
    <div class="row">
        @if( $driver->count() <1 )
        <!-- <div class="main"> -->
            <img src="{{ asset("assets/images/driver.svg") }}" width="100%" height="350px" style="margin-top:50px">
            <center style="font-size:20px"> There are no registered <span style="color:#ffc017">drivers</span> to show yet </center>
        <!-- </div> -->
        @endif
        @foreach($driver as $drivers )
        <div class="col-md-4">



            <div class="card user-card">
                <div class="card-header">
                    <a type="submit" class="btn btn-light" href="{{route('driver.show',$drivers->id)}}">Profile</a>
                </div>
                <div class="card-block">
                    {{-- <div class="form-check form-switch" style="margin-top: -25px; margin-bottom: 16px;"> <input
                            class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked> </div> --}}
                    <span  class="badge <?php echo ($drivers['confirmed']=='1') ? 'bg-success' : 'bg-danger'; ?> "><?php echo ($drivers['confirmed']=='1') ? 'Active' : 'Inactive'; ?></span> 
                    <div class="user-image">
                        {{-- <img src="upload/driver/{{$drivers->image_path}}" class="img-radius" alt="User-Profile-Image"> --}}
                        <img src="{{$drivers->image_path}}" class="img-radius" alt="User-Profile-Image">
                    </div>
                    <h6 class="f-w-600 m-t-25 m-b-10"> {{$drivers->name}}</h6>
                    {{-- <p class="text-muted">Active | Male | Born 23.05.1992</p> --}}
                    <hr>
                    <p class="text-muted m-t-15">Mobile Number: {{$drivers->mobileNumber}}</p>
                    <p class="text-muted m-t-15">Email: {{$drivers->email}}</p>

                    {{-- <p class="m-t-15 text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> --}}
                    <hr>
                    <div class="row">

                        <div class="col-sm-4">
                            <a href="{{route('driver.edit',$drivers->id)}}" type="submit"
                                class="btn btn-primary">UPDATE</a>
                        </div>

                        {{-- <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary">ASSIGN</button>
                        </div> --}}

                        <div class="col-sm-4">
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
    </div>
    {{ $driver->links() }}
    <!-- <button>Show Alert</button> -->
    @if (session('success'))
    <div class="alertg hide">
        <span class='fas fa-check-circle'></span>
        <span class="msg">{{ session('success') }}</span>
        <div class="close-btn">
            <span class="fas fa-times"></span>
        </div>
    </div>
    @endif



    @endsection
