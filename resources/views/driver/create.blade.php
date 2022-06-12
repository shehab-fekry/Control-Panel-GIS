@extends('layouts.master')

@section('content')
<div class="app-main__outer bus-container">
    <div class="app-main__inner">
      <div class="content-header">

    </div>
      {{-- <section class="vh-100 gradient-custom" style="border-radius: 20px; border: none; "> --}}
        {{-- <div class=" py-5 h-100"  style="background: url(k.jfif); background-size: cover;"> --}}
          {{-- <div class="row justify-content-center align-items-center "  > --}}
            {{-- <div class="col-12 col-lg-9 col-xl-7"> --}}
              <div class="card shadow-2-strong card-registration">
                <div class="headingDriver card-body p-4 p-md-5" >
                    <form action="{{route('driver.store')}}" method="POST" class="row g-3" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="col-md-6 mb-4">

                          <div class="form-outline">
                            <label class="form-label" for="Name">Name</label>

                            <input type="text" id="Name" class="form-control form-control-lg  @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autocomplete="name" autofocus  />
                          </div>

                        </div>
                        <div class="col-md-6 mb-4 pb-2">

                          <div class="form-outline">
                            <label class="form-label" for="emailAddress">Email</label>

                            <input type="email" id="emailAddress" class="form-control form-control-lg @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" />
                          </div>
                          @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                         <div class="row">
                        <div class="col-md-6 mb-4 pb-2">

                          <div class="form-outline">
                            <label class="form-label" for="emailAddress">password</label>

                            <input type="password" id="password" class="form-control form-control-lg  @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password" />
                            @error('password')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                          </div>

                        </div>
                        <div class="col-md-6 mb-4 pb-2">

                          <div class="form-outline">
                            <label class="form-label" for="password-confirm">confirm password</label>

                            <input type="password" id="password-confirm" class="form-control form-control-lg"  name="password_confirmation"
                            required autocomplete="new-password" />
                          </div>

                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 mb-4 pb-2">

                          <div class="form-outline">

                            <label class="form-label" for="mobileNumber">Phone Number</label>

                            <input type="text" id="mobileNumber" class="form-control form-control-lg  @error('mobileNumber') is-invalid @enderror"
                            name="mobileNumber" required />

                          </div>

                        </div>

                        <div class="col-md-6 mb-4 d-flex align-items-center">

                          <div class="form-outline datepicker w-100">

                            <label for="licenseNumber"  class="form-label">licenseNumber</label>

                            <input
                              type="text" name="licenseNumber"
                              class="form-control form-control-lg"
                              id="licenseNumber"
                            />
                          </div>

                        </div>

                      </div>

                     {{-- <div class="row">
                      <div class="col-md-12 mb-4 d-flex align-items-center">

                        <div class="form-outline datepicker w-100">
                          <label for="image"  class="form-label">Photo</label>

                          <input
                            type="file" name="image"
                            class="form-control form-control-lg"
                            id="image"
                          />
                        </div>

                      </div>

                     </div> --}}



                      <div class="row">

                          <div class="col-md-6 mb-4 pb-2">
                          <div >
                            <input class="btn  btn-primary btn-lg" style="border-radius: 20px; width: 90px; background-color: #ffc107; border: none; color: rgb(255, 255, 255);" type="submit" value="Submit" />
                          </div>
                         </div>

                      </div>



                    </form>
                  </div>
                {{-- </div> --}}
              {{-- </div> --}}
            </div>
          {{-- </div> --}}
        {{-- </section> --}}
                    {{-- </div> --}}

                @if ($message = Session::get('error'))
                @foreach($message as $messages)
                <div class="alertr hide">
                  <span class='fas fa-exclamation-triangle'></span>
                  <span class="msg">{{$messages}}</span>
                  <div class="close-btn">
                     <span class="fas fa-times"></span>
                  </div>
                  </div>

               @endforeach
               @endif
    </div>
</div>

@endsection
