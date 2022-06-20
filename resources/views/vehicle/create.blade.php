@extends('layouts.master')

@section('content')   
<div class="app-main__outer">
    <div class="app-main__inner">
      <div class="content-header">
        
    </div>
      <section class="vh-100 gradient-custom" style="border-radius: 20px; border: none; "> 
         <div class=" py-5 h-100"  style="background: url(k.jfif); background-size: cover;"> 
          <div class="row justify-content-center align-items-center "  > 
             <div class="col-12 col-lg-9 col-xl-7"> 
              <div class="card shadow-2-strong card-registration">
                <div class="headingvehicle card-body p-4 p-md-5" >
                    <form action="{{route('vehicle.store')}}" method="POST"class="row g-3">
                        @csrf
                      <div class="row">
                        <div class="col-md-12 mb-4">
        
                          <div class="form-outline">
                            <label class="form-label" for="licensePlate">License Plate</label>
      
                            <input type="text" id="licensePlate" class="form-control form-control-lg  @error('licensePlate') is-invalid @enderror" name="licensePlate"
                            value="{{ old('licensePlate') }}" required autocomplete="licensePlate" autofocus  />
                          </div>
        
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 mb-4 pb-2">
        
                          <div class="form-outline">
                            <label class="form-label" for="model">Model</label>
      
                            <input type="text" id="model" class="form-control form-control-lg  @error('model') is-invalid @enderror" name="model"
                            value="{{ old('model') }}" required autocomplete="model" autofocus  />
                          </div>
                          
                          <span class="invalid-feedback" role="alert">
                              <strong></strong>
                          </span>
                        
                        </div>
                    </div>
                      
                         <div class="row">
                        <div class="col-md-12 mb-4 pb-2">
        
                          <div class="form-outline">
                            <label class="form-label" for="color">color</label>
      
                            <input type="color" id="color" class="form-control form-control-lg  @error('color') is-invalid @enderror" name="color"
                            value="{{ old('color') }}" required autocomplete="color" autofocus  />
                           <span class="invalid-feedback" role="alert">
                           <strong></strong>
                           </span>
                          </div>
        
                        </div>
                        <div class="col-md-6 mb-4 pb-2">
        
             
        
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 mb-4 pb-2">
                          <select class="form-select" aria-label="Default select example" name="driver_id">
                          
                            @foreach($driver as  $drivers )
                                      <option value="{{$drivers->id}}">{{$drivers->name}}</option>
                            @endforeach

                          </select>
        
                        </div>
                      </div>
        
                     
        
                      <div class="row">
      
                          <div class="col-md-6 mb-4 pb-2">
                          <div >
                            <input class="btn  btn-primary btn-lg" style="border-radius: 10px; height: 50px; width: 100px; background-color: #ffc107; border: none; color: rgb(255, 255, 255);" type="submit" value="Submit" />
                          </div>
                         </div>
                        
                      </div>
        
                    
        
                    </form>
                  </div>
        

    </div>
    @if ($message= session('error'))
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
@endsection