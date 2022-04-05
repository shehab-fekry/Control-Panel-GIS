@extends('layouts.master')
@section('content')

<div class="profile-page">
      
    <div class="row gutters-sm">
      <div class="col-md-4 mb-3 profile-left">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
              <img src="{{asset('upload/admin/'.Auth::user()->image_path)}} " alt="Admin photo" class="rounded-circle" width="150">
              <div class="mt-3">
                <h4>{{ Auth::user()->name }} </h4>
                {{-- <p class="text-secondary mb-1">Full Stack Developer</p> --}}
                <p class="text-muted font-size-sm">{{ Auth::user()->email }} </p>
                  <div class="col-sm-12">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                         class="btn trackingBtn" >{{ __('Logout') }}
                         <form id="logout-form" action="{{ route('logout') }}" method="POST"
                         class="d-none">
                         @csrf
                     </form>
                        
                        </a>
                  </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="col-md-8 profile-right">
        <div class="card mb-3">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Full Name</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{ Auth::user()->name }} 
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Email</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{ Auth::user()->email }} 
              </div>
            </div>
       
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">School Name</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                @if ($schools == Null)
                  You don't join to  any school yet.
                @else
                {{ $schools->name  }} 
                @endif
                
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Created At</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{ Auth::user()->created_at->format('Y-m-d') }} 
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Updated At</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{ Auth::user()->updated_at->format('Y-m-d')  }} 
              </div>
            </div>
          </div>
        </div>
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