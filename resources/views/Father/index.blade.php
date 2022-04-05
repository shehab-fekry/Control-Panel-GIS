@extends('layouts.master')

@section('content')

<link rel="stylesheet" href="{{ asset("css/Findex.css") }}">
<div class="bus-container">

            <div class="row">
                @foreach($fathers as $parent )
                <div class="col-md-4">


                    <div class="card user-card" >
                        <div class="card-header">
                            <a type="submit" class="btn btn-light" href="{{route('father.show',$parent->id)}}">Profile</a>
                        </div>
                        <div class="card-block">
                            <span  class="badge <?php echo ($parent['confirmed']=='1') ? 'bg-success' : 'bg-danger'; ?> "><?php echo ($parent['confirmed']=='1') ? 'Active' : 'Inactive'; ?></span> 
                            {{-- <input data-id="{{$parent->id}}" class="toggle-class" type="checkbox" data-bs-onstyle="success" data-bs-offstyle="danger" data-bs-toggle="toggle" data-bs-on="Active" data-bs-off="InActive" {{ $parent->confirmed ? 'checked' : '' }}>
                            <div class="form-check form-switch" style="margin-top: -25px; margin-bottom: 16px;"> <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked> </div> --}}
                            <div class="user-image">
                                <img src="upload/father/{{$parent->image_path}}" class="img-radius" alt="User-Profile-Image">
                            </div>
                            <h6 class="f-w-600 m-t-25 m-b-10">{{$parent->name}}</h6>
                            {{-- <p class="text-muted">Active | Male | Born 23.05.1992</p> --}}
                            <hr>
                            <p class="text-muted m-t-15">Mobile Number: {{$parent->mobileNumber}}</p>
                            <p class="text-muted m-t-15">Email: {{$parent->email}}</p>

                            {{-- <p class="m-t-15 text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> --}}
                            <hr>
                            <div class="row">

                            <div class="col-sm-4">
                                <a href="{{route('father.edit',$parent->id)}}" type="submit" class="btn btn-primary">UPDATE</a>
                             </div>

                                {{-- <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary">ASSIGN</button>
                             </div> --}}

                            <div class="col-sm-4">
                                <form action="{{route('father.destroy',$parent->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">DELETE</button>
                                </form>
                             </div>
                             </div>
                        </div>
                    </div>
            </div>
            @endforeach

            </div>

            <!-- <button>Show Alert</button> -->
          {{-- <div class="alertw hide">
         <span class="fas fa-exclamation-circle"></span>
         <span class="msg">Warning: This is a warning alert!</span>
         <div class="close-btn">
            <span class="fas fa-times"></span>
         </div>
         </div>
          <div class="alertr hide">
         <span class='fas fa-exclamation-triangle'></span>
         <span class="msg">Warning: This is a warning alert!</span>
         <div class="close-btn">
            <span class="fas fa-times"></span>
         </div>
         </div> --}}
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
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var user_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeStatus',
            data: {'confirmed': confirmed, 'id': id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })
             
        </script>  
        
</div>  

@endsection
