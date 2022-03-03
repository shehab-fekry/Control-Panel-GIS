@extends('driver.layout')

@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="row">
            {{-- <div class="container py-4">


    <div class="p-1 mb-4 bg-light ">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Father</h1>
            <p class="col-md-8 fs-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae debitis quas consectetur animi cumque. Reiciendis odio nulla assumenda quod similique?</p>
            <a href="{{route('father.create')}}" class="btn btn-primary btn-lg" type="button">Create</a>
        </div>
    </div>
    <div class="continer">
        @if ($message = Session::get('success'))
        <div class="row">
            <div class="col">
            </div>
            <div class="alert alert-success" role="alert">
                {{$message}}
            </div>
        </div>
        @endif

    </div>
</div> --}}
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-dark">drivers Info
                </h3>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">drivers Info</li>
                </ol>
            </div>
            <!-- /.col -->
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

</div>
</div>
</div>
</div>
</div>
</div>
@endsection
