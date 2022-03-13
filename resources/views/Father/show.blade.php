@extends('Father.layout')

@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
{{-- <section class="vh-100 gradient-custom" style="border-radius: 20px; border: none; overflow: scroll;">    --}}
    <div   style="background: url(k.jfif); background-size: cover;">
      <div class="row justify-content-center align-items-center"  >
        {{-- <div class="col-12 col-lg-9 col-xl-7"> --}}
          {{-- <div class="card shadow-2-strong card-registration" style="border-radius: 5px;margin-bottom: 20px; border: none;"> --}}
            <div class="headingProfileParent card-body p-4 p-md-5" style="background-color:#fafafa; box-shadow: 0px 0px 5px #ccc; border-radius: 20px; border: none; ">

          
     
  
      <div class="row" >
        <div class="col-lg">
          <div class="card mb-4"style="background-color: whitesmoke;">
            <div class="card-body text-center" >
              <img src="{{asset('upload/father/'.$father->image_path)}}" alt="avatar" class="rounded-circle img-fluid" style="width: 125px; hieght: 125px">
              <h5 class="my-3">{{$father->name}}</h5>
              <p class="text-muted mb-1">Full Stack Developer</p>
              <p class="text-muted mb-4">lives in 6 october</p>
            
            </div>
          </div>
        
        </div>
        <div class="col-lg-8">
          <div class="card mb-4"style="background-color: whitesmoke;">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0"> Name</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$father->name}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$father->email}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Phone</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$father->mobileNumber}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Region</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$father->region}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">status</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$father->status}}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Child</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"> two children</p>
                </div>
              </div>
   
            </div>
          </div>
      
        </div>
      </div>
      {{-- ---------------------------------------------------------------------------------- --}}
      <div class="row" >
        <div class="col-lg-4">
          <div class="card mb-4"style="background-color: whitesmoke;">
            <div class="card-body text-center" >
           <h5 class="mb-4 pb-2 pb-md-0 mb-md-3" style="margin-left: 20px; padding-top: 20px; font-weight: 700; font-size: 20px;">Add Child</h5>    

                    <label class="form-label" for="Name" >Name</label>
                    <input type="text" id="Name" class="form-control form-control-lg"  />
                    <label for="file" class="form-label" style=" margin-left: 20px;">Photo</label>
                    <input type="file"  class="form-control form-control-lg"  id="Photo"/>
                  <input class="btn btn-primary btn-lg mt-2" style="background-color: #384850; color: aliceblue;" type="submit" value="ADD" />

                </div>
              </div>
        
        </div>
        <div class="col-lg-8">
          <div class="card mb-8"style="background-color: whitesmoke;">
            <div class="card-body">
              <div class="col">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Child Photo</th>
                      <th scope="col">Child Name</th>
                      <th scope="col">Status</th>
                      <th scope="col">Confirmation</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>
                        <img src="/upload/father/parent.png" width="30" class="user-img rounded-circle mr-2">
                      </td>
                      <td>Child</td>
                      <td>
                        <input class="form-check-input" type="checkbox" id="checkboxNoLabel" >
                    </td>
                      <td>
                        <div class="form-check form-switch" > <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked> </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
                  {{-- <div class="d-flex justify-content-between align-items-center">
                    <label class="form-label" for="status" style="margin-left: 10px;">Child</label>

                    <label class="form-label" for="status" style="margin-left: 140px;">Status</label>
                    <label class="form-label" for="Confirmatiom" style="margin-left: 140px;">Confirmation</label>
                  </div>
               
                  
                
            <div class="card p-3 mt-2" style="background-color: whitesmoke">
              <img src="/Public/assets/manager.png" width="30" class="user-img rounded-circle mr-2" style="margin-bottom: -30px;">
                <span "><small class="font-weight-bold text-primary" style="margin-left: 50px; ">james_olesehhhhhhnn</small>

                 <div style="margin-left: 200px; margin-bottom: -25px;">
                   <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
                 </div>
                  <div class="buttons" style="margin-left: 370px; "> <span class="badge bg-white d-flex flex-row align-items-center"> 
               <div class="form-check form-switch" > <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked> </div>
           </span>
          </div>
      
            
        </div>
       
    </div>
    </div> --}}
              </div>
            </div>
          </div>
        </div>
   
      </div>
   </div>
      
  </div>
</div>
     

@endsection
