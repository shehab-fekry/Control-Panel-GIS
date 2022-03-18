@extends('layouts.master')

@section('content')

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="container bg-white">
            <div class="row ">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="{{asset('upload/admin/'.Auth::user()->image_path)}} " alt="{{asset('upload/nophoto.svg')}}" onerror="this.src='{{asset('upload/nophoto.svg')}}';" ><span class="font-weight-bold"></span><span class="text-black-50"></span><span> </span></div>
                </div>
                <div class="col">
                    <div>
                        <div class="d-flex justify-content-between align-items-center" >
                            
                        </div>
                    
                     <form action="{{route('admin.update',$admin->id)}}" method="POST" class="row g-3" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                            <div class="row">
                                <div class="col-md-12 mb-4">
                
                                  <div class="form-outline">
                                    <label class="form-label" for="License Plate">Name</label>
              
                                    <input type="text" id="License late" name="name" class="form-control form-control-lg"
                                     required autocomplete="Name" autofocus value="{{ $admin->name }} " />
                                  </div>
                
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12 mb-4 pb-2">
                
                                  <div class="form-outline">
                                    <label class="form-label" for="email">Email</label>
              
                                    <input type="text" id="emailAddress" class="form-control form-control-lg "
                                    name="email" value="{{ $admin->email }}" required autocomplete="Model" />
                                  </div>

                      
                                    <input type="hidden" id="emailAddress" class="form-control form-control-lg "
                                    name="password" value="{{ $admin->password }}" required autocomplete="Model" />
                                 
                                  {{-- <span class="invalid-feedback" role="alert">
                                      <strong></strong>
                                  </span> --}}
                                
                                </div>
                            </div>
                              
                                 <div class="row">
                                <div class="col-md-12 mb-4 pb-2">
                
                                  <div class="form-outline">
                                    <label class="form-label" for="school_id">School Name</label>
              
                                    <input type="text" id="color" class="form-control form-control-lg "
                                    name="school_id" value="{{ $admin->school_id }}" required autocomplete="School Name" />
                                   {{-- <span class="invalid-feedback" role="alert">
                                   <strong></strong>
                                   </span> --}}
                                  </div>
                
                                </div>
                                <div class="col-md-6 mb-4 pb-2">
                
                     
                
                                </div>
                              </div>
                              <div class="row">
                             
        
                                <div class="col-md-6 mb-4 d-flex align-items-center">
                
                                  <div class="form-outline datepicker w-100">
                                    
              
                                    <input type="file" name="image_path" id="file" class="inputfile" />
                                                {{-- <label for="image_path" style="margin-left: -1px; margin-top: -10px;">Choose a file</label> --}}
                                  </div>
                
                                </div>
                               
                              </div>
                
                        
                        
                        
                        
                        <div class="form-outline datepicker w-100" style="margin-left: 5px;"><button class="btn btn-primary profile-button" type="submit">Save Profile</button>
                        </form>
                        </div>
                    </div>
               
                </div>
               
            </div>
        </div>
        </div>
@endsection
