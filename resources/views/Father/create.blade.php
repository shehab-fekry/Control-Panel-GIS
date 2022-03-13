@extends('Father.layout')

@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
                      <form>
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Add Account</h3>

                        <div class="row">
                          <div class="col-md-6 mb-4">
          
                            <div class="form-outline">
                              <input type="text" id="firstName" class="form-control form-control-lg" />
                              <label class="form-label" for="firstName">First Name</label>
                            </div>
          
                          </div>
                          <div class="col-md-6 mb-4">
          
                            <div class="form-outline">
                              <input type="text" id="lastName" class="form-control form-control-lg" />
                              <label class="form-label" for="lastName">Last Name</label>
                            </div>
          
                          </div>
                        </div>
          
                        <div class="row">
                          <div class="col-md-6 mb-4 d-flex align-items-center">
          
                            <div class="form-outline datepicker w-100">
                              <input
                                type="text"
                                class="form-control form-control-lg"
                                id="Date"
                              />
                              <label for="Date" class="form-label">Date</label>
                            </div>
          
                          </div>
                         
                        </div>
          
                        <div class="row">
                          <div class="col-md-6 mb-4 pb-2">
          
                            <div class="form-outline">
                              <input type="email" id="emailAddress" class="form-control form-control-lg" />
                              <label class="form-label" for="emailAddress">Email</label>
                            </div>
          
                          </div>
                          <div class="col-md-6 mb-4 pb-2">
          
                            <div class="form-outline">
                              <input type="tel" id="phoneNumber" class="form-control form-control-lg" />
                              <label class="form-label" for="phoneNumber">Phone Number</label>
                            </div>
          
                          </div>
                        </div>
          
                        <div class="row">
                          <div class="col-12">
          
                            <select class="select form-control-lg" style="background-color: #252C4B; color: aliceblue;">
                              <option value="1" disabled style="background-color:  #dadce4; color: rgb(18, 18, 19);">Choose option</option>
                              <option value="2" style="background-color: #dadce4; color: rgb(18, 18, 19);">child 1</option>
                              <option value="3" style="background-color: #dadce4; color: rgb(18, 18, 19);">child 2</option>
                              <option value="4" style="background-color: #dadce4; color: rgb(18, 18, 19);">child 3</option>
                              <option value="4" style="background-color: #dadce4; color: rgb(18, 18, 19);">more..</option>
                            </select>
                            <label class="form-label select-label">Choose option</label>
          
                          </div>
                        </div>
          
                        <div class="mt-4 pt-2">
                          <input class="btn btn-primary btn-lg" style="background-color: #252C4B; color: aliceblue;" type="submit" value="Submit" />
                        </div>
          
                      </form>
                    </div>

    </div>
</div>

@endsection
