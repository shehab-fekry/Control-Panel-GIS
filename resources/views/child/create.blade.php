@extends('child.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="continer pt-5">
                <div class="row">
                    <div class="col">
                <div class="card ">
                <div class="card-body bg-info ">
                  Add New child.
                </div>
              </div></div>
                </div>
            </div>
<div class="my-5"></div>
            <form action="{{route('child.store')}}" method="POST" class="row g-3">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('status') }}</label>

                    <div class="col-md-6">
                        <input id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="m_number" required >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="father_id" class="col-md-4 col-form-label text-md-end">{{ __('father id') }}</label>

                    <div class="col-md-6">
                        <input id="father_id" type="text" class="form-control @error('father_id') is-invalid @enderror" name="trip_id" required >
                    </div>
                </div>          
                
                <div class="col-12 form-group">
                    <button type="submit"  class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
