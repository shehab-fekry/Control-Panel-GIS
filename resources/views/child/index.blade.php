@extends('child.layout')

@section('content')
<div class="container py-4">


    <div class="p-1 mb-4 bg-light ">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Father</h1>
            <p class="col-md-8 fs-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae debitis quas consectetur animi cumque. Reiciendis odio nulla assumenda quod similique?</p>
            <a href="{{route('child.create')}}" class="btn btn-primary btn-lg" type="button">Create</a>
        </div>
    </div>
<div class="continer">
    @if ($message = Session::get('success'))
      <div class="row">
        <div class="col">
        </div>
        <div class="alert alert-success" role="alert">
          {{$message}}
        </div>
        </div>  
    @endif
    
    </div>
</div>

    <div class="container">
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">name</th>
                            <th scope="col ">mobileNumber</th>
                            <th scope="col ">trip_id</th>
                            <th scope="col ">status</th>
                            <th scope="col ">Operations</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($child as $child )
                        <tr>
                            <th scope="row">{{$parent->id}}</th>
                            <td>{{$child->name}}</td>
                            <td>{{$child->mobileNumber}}</td>
                            <td>{{$child->trip_id}}</td>
                            <td>{{$child->status}}</td>
                            <td>
                                <div class="row">
                                    <div class="col-sm"> <a href="{{route('father.edit',$parent->id)}}"
                                            class="btn btn-success  ">Edit</a></div>
                                    <div class="col-sm"> <a href="{{route('father.show',$parent->id)}}"
                                            class="btn btn-primary">Show</a></div>
                                    <div class="col-sm">
                                        <form action="{{route('father.destroy',$parent->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>


                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $father->links()!!}
            </div>
        </div>
    </div>
    @endsection
