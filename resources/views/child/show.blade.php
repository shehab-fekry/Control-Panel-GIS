@extends('child.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col ">
            <div class="continer pt-5">
                <div class="row">
                    <div class="col">
                <div class="card ">
                <div class="card-body bg-warning">
                 <h4>Show  {{$child->name}}</h4> 
                </div>
              </div></div>
                </div>
            </div>
                <div class="col-md-6 form-group " >status: 
                    <label class="form-label">{{$child->status}}</label>
                </div>
                <div class="col-md-6 form-group"> father_id: 
                    <label  class="form-label">{{$child->father_id}}</label>
                </div>
                <div class="col-md-6 form-group"> created_at: 
                    <label  class="form-label">{{$child->created_at}}</label>
                </div>
                <div class="col-md-6 form-group">updated_at: 
                    <label  class="form-label">{{$child->updated_at}}</label>
                </div>
                <div class="col-md-6 form-group">
                <a  href="{{route('child.index') }}" class="btn btn-danger">Return home</a>
                </div>

        </div>
    </div>
</div>

@endsection
