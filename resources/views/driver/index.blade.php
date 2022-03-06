<%- contentFor('body') %>

<div class="container">
           
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
          
         <img src="https://media.istockphoto.com/vectors/young-male-worker-avatar-flat-illustration-police-man-bus-driver-vector-id1166844534?k=20&m=1166844534&s=612x612&w=0&h=HMbuCf3Bu5HSHsk6r663jDrrrTBD76LiwriQoq2yzXo=" alt="">
          
        </div>
            <div class="text">
                <h4>captain ahmed</h4>
                <p>  iam driving bus 1 in trip numper 1 and my phone is 01113334444
                </p>  
                <div class="but">
                    <a href=""><button class="b">UPDATE</button></a>
                               <button class="b">DELETE</button>
                               <button class="b">ASSIGN</button>
                 </div>
             </div>

    </div>
    
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
                <img src="https://media.istockphoto.com/vectors/young-male-worker-avatar-flat-illustration-driver-taxi-driver-vector-id1166844536?k=20&m=1166844536&s=612x612&w=0&h=iVRkI4CeiNq8IUNhM5Jt005xGaUUEm3RXwm7L8SX7EQ=" alt="">
               
            </div>
                <div class="text">
                    <h4> captain gamal </h4>
                    <p>  iam driving bus 2 in trip numper 4 and my phone is 01112234555
                    </p>
                    <div class="but">
                        <a href=""><button class="b">UPDATE</button></a>
                                   <button class="b">DELETE</button>
                                   <button class="b">ASSIGN</button>
                     </div>
                </div>
           
        </div>
             
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
                     <img src="https://media.istockphoto.com/vectors/young-male-worker-avatar-flat-illustration-driver-taxi-driver-vector-id1166844459?k=20&m=1166844459&s=612x612&w=0&h=-xp3jP-nNCcxyE3LXmTsadSHyIaFzDOcJV6gZ4_Cg80=" alt="">
                
                </div>
                    <div class="text">
                        <h4>captain hisham</h4>
                        <p>  iam driving bus 3 in trip numper 2 and my phone is 01113378955
                        </p>
                        <div class="but">
                            <a href=""><button class="b">UPDATE</button></a>
                                       <button class="b">DELETE</button>
                                       <button class="b">ASSIGN</button>
                        </div>

                    </div>
        </div>

        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- Main content -->
<div class="container-fluid">
    <div class="card">
        <div class="card-body p-0">
            <div class="table">
                <table id="driverslisttbl" class="table card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th scope="row" class="w-1">id</th>
                            <th scope="row">name</th>
                            <th scope="row">photo</th>
                            <th scope="row">email</th>
                            <th scope="row">licenseNumber</th>
                            <th scope="row">confirmed</th>
                            <th scope="row">mobileNumber</th>
                            <th scope="row">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($driver as $drivers )
                        <tr>
                            <th scope="row">{{$drivers->id}}</th>
                            <td>{{$drivers->name}}</td>
                            <td>
                                <img src="{{asset('upload/driver/'.$drivers->image_path)}}" width="10%" alt="" srcset="">
                            </td>
                            <td>{{$drivers->email}}</td>
                            <td>{{$drivers->licenseNumber}}</td>
                            <td><span class="badge <?php echo ($drivers['confirmed']=='1') ? 'badge-success' : 'badge-danger'; ?> "><?php echo ($drivers['confirmed']=='1') ? 'YES' : 'NO'; ?></span>  
                            </td>
                            {{-- <td>{{$drivers->confirmed}}</td> --}}
                            <td>{{$drivers->mobileNumber}}</td>
                            <td>
                                <div class="row">
                                    <div class="col-sm"> <a href="{{route('driver.edit',$drivers->id)}}"
                                            class="btn fa fa-lg  fa-edit "></a></div>
                                    <div class="col-sm"> <a href="{{route('driver.show',$drivers->id)}}"
                                            class="btn fas fa-lg fa-eye"  style="color:green"></a></div>
                                    <div class="col-sm">
                                        <form action="{{route('driver.destroy',$drivers->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn fa-lg far fa-trash-alt" style="color:Red"></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $driver->links()!!}
            </div>

        </div>
     </div>                       
     </div> 
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
      
     <img src="https://media.istockphoto.com/vectors/young-male-worker-avatar-flat-illustration-police-man-bus-driver-vector-id1166844534?k=20&m=1166844534&s=612x612&w=0&h=HMbuCf3Bu5HSHsk6r663jDrrrTBD76LiwriQoq2yzXo=" alt="">
       
    </div>
        <div class="text">
            <h4>captain ahmed</h4>
            <p>  iam driving bus 1 in trip numper 1 and my phone is 01113334444
            </p>  
            <div class="but">
                <a href=""><button class="b">UPDATE</button></a>
                           <button class="b">DELETE</button>
                           <button class="b">ASSIGN</button>
            </div>
        </div>

      </div>
        <button class="g"> 
            <i class="fa fa-plus-circle" style="font-size:80px;color:#252C4B"></i>
        </button>
</div>