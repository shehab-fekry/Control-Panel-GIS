@extends('layouts.master')

@section('content')
<div class="bus-container">
<div class="app-main__outer">
    <div class="app-main__inner">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
          <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
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
              <img src="{{$father->image_path}}" alt="100*100" class="rounded-circle img-fluid" style="width: 125px; hieght: 125px"  data-bs-rendered="true">
              <h5 class="my-3">{{$father->name}}</h5>
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
                  <p class="mb-0">Status</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$father->status}} child will going.</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Confirmation</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">
                    <span  class="badge <?php echo ($father['confirmed']=='1') ? 'bg-success' : 'bg-danger'; ?> "><?php echo ($father['confirmed']=='1') ? 'confirmed' : 'Not confirmed'; ?></span>
                  </p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Child</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"> {{$father->child()->count()}} child</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Trip</p>
                </div>
                <div class="col-sm-9">
                    @foreach($trips as  $trip )
                    @if( $trip->id == $father->trip_id)
                    <a href="{{route('trip.show',$trip->id)}}" class="text-muted mb-0">{{$trip->geofence}}
                    @endif
                    @endforeach
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>


      @if($father->child()->count() >=1) {{-- if there childs --}}
      <div class="table father-child-table" style="width: 100%">
        <div class="roow head_row">
            <div class="head_data">ID</div>
            <div class="head_data">Photo</div>
            <div class="head_data">Name</div>
            <div class="head_data tdata-btns">Age</div>
            <div class="head_data tdata-btns">Class</div>
            <div class="head_data tdata-btns">Gender</div>
            <div class="head_data tdata-btns">Status</div>
            <div class="head_data tdata-btns">Confirmation</div>

        </div>

        @foreach($childs as $child )
        @if ($child->father_id == $father->id) {{-- if child belongs to this father --}}
                <div class="roow-father">
                  <div class="tdata" scope="row">{{$child->id}}</div>
                  <div class="tdata">
                       <img src="{{$child->image_path}}" width="30" class="user-img rounded-circle mr-2">
                  </div>
                  <div class="tdata">{{$child->name}}</div>
                  <div class="tdata"> {{$child->age}}</div>
                  <div class="tdata"> {{$child->class}} </div>
                  <div class="tdata"> {{$child->gender}} </div>
                  <div class="tdata"> 
                  <span class="badge <?php echo ($child['status']=='1' || $child['status']=='true') ? 'bg-success' : 'bg-danger'; ?> "><?php echo ($child['status']=='1' || $child['status']=='true') ? 'Active' : 'Inactive'; ?></span>   
                  </div>

                  <div class="tdata">
                    <div class="form-check form-switch" >
                        <input data-id="{{$child->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Yes" data-off="No" {{ $child->confirmed ? 'checked' : '' }}>
                    </div>
                  </div>
                </div>
        @endif
        @endforeach
      @endif
      @if($father->child()->count() <1) {{-- if there is no childs --}}
        <div class="roow-father">
        <center style="font-size:20px; padding:10px">There are no added <span style="color:#ffc017">children</span> to show yet </center>
        </div>
      @endif
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

<script>
  $(function() {
    $('.toggle-class').change(function() {
        var confirmed = $(this).prop('checked') == true ? 1 : 0;
        var mid = $(this).data('id');
        $.ajax({
            type: "get",
            dataType: "json",
            url: '{{ route('changeStatus') }}',
            data: {

              'confirmed': confirmed, 'mid': mid},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })
</script>

</div>

@endsection
