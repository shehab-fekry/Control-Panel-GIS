@extends('layouts.master')

@section('content')   
<div class="bus-container">
<div class="container bg-white" style="height:550px;">
    <div class="row ">
        {{-- <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold"></span><span class="text-black-50"></span><span> </span></div>
        </div> --}}
        <div class="col">
            <div>
                <div class="d-flex justify-content-between align-items-center" >
                    
                </div>
                <form action="{{route('vehicle.update',$vehicle->id)}}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-12 mb-4">
        
                          <div class="form-outline">
                            <label class="form-label" for="License Plate">License Plate</label>
      
                            <input type="text" name="licensePlate" id="License late" class="form-control form-control-lg"
                            value="{{$vehicle->licensePlate}}" required autocomplete="License plate" autofocus  />
                          </div>
        
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 mb-4 pb-2">
        
                          <div class="form-outline">
                            <label class="form-label" for="model">Model</label>
      
                            <input type="text" id="model" class="form-control form-control-lg "
                            name="model" value="{{$vehicle->model}}" required autocomplete="Model" />
                          </div>
                          
                          <span class="invalid-feedback" role="alert">
                              <strong></strong>
                          </span>
                        
                        </div>
                    </div>
                      
                         <div class="row">
                        <div class="col-md-4 mb-4 pb-2">
        
                          <div class="form-outline">
                            <label class="form-label" for="color">color</label>
      
                            <input type="color" id="color" value="{{$vehicle->color}}" class="form-control form-control-lg "
                            name="color" required autocomplete="color" />
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
                            <div class="form-outline">
                              <select class="form-select" aria-label="Default select example" name="driver_id">
                          
                                @foreach($driver as  $drivers )
                                          <option value="{{$drivers->id}}" @if( $drivers->id == $vehicle->driver_id) selected @endif>{{$drivers->name}}</option>
                                @endforeach
    
                              </select>
                                  
                              </div>
                     
        
                        </div>

                        {{-- <div class="col-md-6 mb-4 d-flex align-items-center">
        
                          <div class="form-outline datepicker w-100">
                            
      
                            <input type="file" name="file" id="file" class="inputfile" />
                                        <label for="file" style="margin-left: -180px; margin-top: -10px;">Choose a file</label>
                          </div>
        
                        </div> --}}
                       
                      </div>
        
                
                
                
                
                <div class="form-outline datepicker w-100" style="margin-left: 5px;"><button class="btn btn-primary profile-button" type="submit">Save Profile</button>
                </form>
                </div>
            </div>
       
        </div>
       
    </div>
</div>
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
@endsection
