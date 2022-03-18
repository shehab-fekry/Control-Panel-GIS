@extends('layouts.master')

@section('content')   
<div class="app-main__outer">
    <div class="app-main__inner">
            <div class="row">
                @foreach($vehicle as $vehicles )

                <div class="col-md-4">
                    <div class="card user-card" >  
                        <div class="card-header">
                            <a type="submit" class="btn btn-light" href="{{route('vehicle.show',$vehicles->id)}}">Profile</a>
                        </div>
                        <div class="card-block">
                            <div class="form-check form-switch" style="margin-top: -55px; margin-bottom: 20px; margin-left: 200px;"> <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked> </div>
                            <h6 class="f-w-600 m-t-25 m-b-10"></h6>
                             <p class="text-muted">license plate: {{$vehicles->licensePlate}}</p> 
                            <hr>
                            <p class="text-muted m-t-15">model: {{$vehicles->model}}</p>
                            color: <input type="color" class="text-muted mb-0 " value="{{$vehicles->color}}" disabled>

                            
                            <p class="m-t-15 text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> 
                            <hr>
                            <div class="row">

                            <div class="col">
                                <a href="{{route('vehicle.edit',$vehicles->id)}}" type="submit" class="btn btn-primary">UPDATE</a>
                             </div>

                                <div class="col">
                                <button type="submit" class="btn btn-primary">ASSIGN</button>
                             </div>

                            <div class="col">
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
@endsection
           