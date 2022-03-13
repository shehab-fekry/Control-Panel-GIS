@extends('Father.layout')

@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="container"> 
        @foreach($fathers as $parent )

            <div class="box">
                <div class="links">
                    <span class="icon">
                        <span></span>
                        <span></span>
                        <span></span>                             
                    </span>
                    <ul>
                        <li><a href="#TRIP 1">TRIP 1</a></li>
                        <li><a href="#TRIP 2">TRIP 2</a></li>
                        <li><a href="#TRIP 3">TRIP 3</a></li>
                        <li> <a href="#TRIP 4">TRIP 4</a></li>
                    </ul>
                </div> 
                   
                <div class="thump">

                    <img src="{{$parent->image_path}}" >

                </div>
             
                    <div class="text">
                        <h4>{{$parent->name}}</h4>
                        <p> mobile: {{$parent->mobileNumber}} <br> email : {{$parent->email}}
                        </p>  

                        <div class="but">
                            <a href=""><button class="b">UPDATE</button></a>
                                       <button class="b">DELETE</button>
                                       <button class="b">ASSIGN</button>
                         </div>
                         
                    </div>
                    </div>
        
            @endforeach
           
            <button class="g"> 
                 <i class="fa fa-plus-circle" style="font-size:80px;color:#252C4B "></i>

             </button>

     </div>
     </div>
</div>  
@endsection
