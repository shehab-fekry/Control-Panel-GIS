@extends('Father.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="continer pt-5">
                <div class="row">
                    <div class="col">
                <div class="card ">
                <div class="card-body ">
                 <h4>edit:  {{$child->name}}</h4> 
                </div>
              </div></div>
                </div>
            </div>

            <form action="{{route('child.update',$child->id)}}" method="POST" class="row g-3">
                 @csrf
                @method('PUT')
                <div class="col-md-6 form-group">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{$child->name}}" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label  class="form-label">status</label>
                    <input type="text" name="status" value="{{$child->status}}" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label  class="form-label">father_id</label>
                    <input type="text" name="father_id" value="{{$child->father_id}}" class="form-control">
                </div>
                <div class="col-12 form-group">
                    <button type="submit"  class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
