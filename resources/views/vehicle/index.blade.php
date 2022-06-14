@extends('layouts.master')

@section('content')

<style>
.card-block{
    padding: 10px;
    margin: 5px;
}
.user-card{
    margin: 15px 0;
    border-radius: 15px;
    padding: 15px
}
.card-header{
    border-radius: 15px !important ;
    background-color: #fff !important;
    border:none !important;
}

</style>
<div class="app-main__outer bus-container ">
    <div class="app-main__inner">
            <div class="row">
                @if( $vehicle->count() <1 )
                <!-- <div class="main"> -->
                    <img src="{{ asset("assets/images/Bus.svg") }}" width="100%" height="350px" style="margin-top:50px">
                    <center style="font-size:20px"> There are no registered <span style="color:#ffc017">vehicles</span> to show yet </center>
                <!-- </div> -->
                @endif
                @foreach($vehicle as $vehicles )

                <div class="col-md-4">
                    <div class="card user-card" >
                        <div class="card-header">
                            <a type="submit" class="btn btn-light" href="{{route('vehicle.show',$vehicles->id)}}">Profile</a>
                        </div>
                        <div class="card-block">
                            {{-- <div class="form-check form-switch" style="margin-top: -55px; margin-bottom: 20px; margin-left: 200px;"> <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked> </div> --}}
                            <h6 class="f-w-600 m-t-25 m-b-10"></h6>
                             <p class="text-muted">license plate: {{$vehicles->licensePlate}}</p>
                            <hr>
                            <p class="text-muted m-t-15">model: {{$vehicles->model}}</p>
                            color: <input type="color" class="text-muted mb-0 " value="{{$vehicles->color}}" disabled>


                            {{-- <p class="m-t-15 text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> --}}
                            <hr>
                            <div class="row">

                            <div class="col-sm-7">
                                <a href="{{route('vehicle.edit',$vehicles->id)}}" type="submit" class="btn btn-primary update-btn">UPDATE</a>
                             </div>

                                {{-- <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary">ASSIGN</button>
                             </div> --}}

                            <div class="col-sm-5">
                                <form action="{{route('vehicle.destroy',$vehicles->id)}}" method="POST">
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
            </div>
            </div>
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
