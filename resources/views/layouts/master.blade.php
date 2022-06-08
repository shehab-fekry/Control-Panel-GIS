<!DOCTYPE html> 
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Dashboard
    </title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <!-- Tab Icon  -->
    <link rel="icon" href="{{ asset("assets/images/tracking.svg") }}">
    <!--  JQuery   -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <!-- bootstarp -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
        crossorigin="anonymous">
    <!--   Fonts   -->
    <link href="http://fonts.cdnfonts.com/css/cera-round-pro" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{ asset("css/layout.css")       }}" rel="stylesheet">
    <link href="{{ asset("css/landingPage.css")  }}" rel="stylesheet">
    <link href="{{ asset("css/tracking.css")     }}" rel="stylesheet">
    <link href="{{ asset("css/Drivers.css")      }}" rel="stylesheet">
    <link href="{{ asset("css/Parents.css")      }}" rel="stylesheet">
    <link href="{{ asset("css/alerts.css")       }}" rel="stylesheet">
    <link href="{{ asset("css/confirmEmail.css") }}" rel="stylesheet">
    <link href="{{ asset("css/home.css")         }}" rel="stylesheet">
    <link href="{{ asset("css/adminProfile.css") }}" rel="stylesheet">
    <link href="{{ asset("css/parentDriver.css") }}" rel="stylesheet">
    <!--   mapbox  -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js"></script>
    <!--  Pusher   -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <!-- Chart.js  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <!-- Typed.js  -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <!--   Axios   -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://use.fontawesome.com/e8ca812c5b.js"></script>
    <!--   ReCaptcha   -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
</head>

<body>
    <div class="sideBar">
        <div class="top-side-bar">
            <div class="sidebar-user">
                <img src="{{asset('upload/admin/'.Auth::user()->image_path)}} "  class="sidebar-img">
                <h2>   {{ Auth::user()->name }} </h3>
                    @if (Auth::user()->is_admin == 1)
                    <h4> School Manager </h4>
                    @else
                    <h4> Clerk </h4>
                    @endif
            </div>
        </div>

        <ul class="list-group">
            <a href="{{route('home')}}">     
                <li class="list-group-item mt-2"><i class="fa fa-home" aria-hidden="true"></i> &nbsp; Dashboard</li>
            </a>
            @if (Auth::user()->school_id == NULL)
            <a href="{{route('school.index', Auth::user()->id)}}">     
            @else
               <a href="{{route('school.index', Auth::user()->school_id)}}">     
            @endif
            <li class="list-group-item mt-2"><i class="fa fa-university" aria-hidden="true"></i> &nbsp; School</li>
            </a> 
            <a><li class="list-group-item mt-2" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse-trips" aria-expanded="false">
                <i class="fa fa-subway"></i> &nbsp;Trips </li>
                <div class="collapse" id="dashboard-collapse-trips">
                    <ul class="btn-toggle-nav list-unstyled">
                        <li><a href="{{ route('trip.index') }}" class="list-group-item mt-2 sidebar-dropdown-item" ><i class="fa fa-subway"></i> &nbsp;Tracking</a></li>
                        <li><a href="{{route('trip.indextrip')}}" class="list-group-item mt-2 sidebar-dropdown-item" ><i class="fa fa-pencil-square-o"></i> &nbsp; Update Trips </a></li>
                    </ul>
                </div>
            </a>
            @if (Auth::user()->is_admin == 1)
                  <a><li class="list-group-item mt-2" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse-1" aria-expanded="false">
                <i class="fa fa-id-card"></i> &nbsp;Drivers</li>
                <div class="collapse" id="dashboard-collapse-1">
                    <ul class="btn-toggle-nav list-unstyled">
                        <li><a href="{{route('driver.index')}}" class="list-group-item mt-2 sidebar-dropdown-item" ><i class="fa fa-id-card"></i> &nbsp;Show Drivers</a></li>
                        <li><a href="{{route('driver.create')}}" class="list-group-item mt-2 sidebar-dropdown-item" ><i class="fa fa-plus-square-o"></i> &nbsp;Add New Driver</a></li>
                    </ul>
                </div>
            </a>

            <a><li class="list-group-item mt-2" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse-2" aria-expanded="false">
                <i class="fa fa fa-users"></i> &nbsp;Parents</li>
                <div class="collapse" id="dashboard-collapse-2">
                    <ul class="btn-toggle-nav list-unstyled">
                        <li><a href="{{route('father.index')}}" class="list-group-item mt-2 sidebar-dropdown-item" ><i class="fa fa-users"></i> &nbsp;Show Parents</a></li>
                        <li><a href="{{route('father.create')}}" class="list-group-item mt-2 sidebar-dropdown-item" ><i class="fa fa-plus-square-o"></i> &nbsp;Add New Parent</a></li>
                    </ul>
                </div>
            </a>

            <a><li class="list-group-item mt-2" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse-vehicles" aria-expanded="false">
                <i class="fa fa-bus"></i> &nbsp;Vehicles </li>  
                <div class="collapse" id="dashboard-collapse-vehicles">
                  <ul class="btn-toggle-nav list-unstyled">
                    <li><a href="{{route('vehicle.index')}}" class="list-group-item mt-2 sidebar-dropdown-item" ><i class="fa fa-bus"></i> &nbsp;Show Vehicles</a></li>
                    <li><a href="{{route('vehicle.create')}}" class="list-group-item mt-2 sidebar-dropdown-item" ><i class="fa fa-plus-square-o"></i> &nbsp;Add Vehicle</a></li>
                  </ul>
                </div>
            </a>
                
            @endif
       
            <a><li class="list-group-item mt-2" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse-profile" aria-expanded="false">
                <i class="fa fa-user-circle"></i> &nbsp;
                @if (Auth::user()->is_admin == 1)
                Admin 
                @else
                Clerk
                @endif
            </li>  
                <div class="collapse" id="dashboard-collapse-profile">
                  <ul class="btn-toggle-nav list-unstyled">
                    <li><a href="{{route('admin.index')}}" class="list-group-item mt-2 sidebar-dropdown-item" ><i class="fa fa-user-circle"></i> &nbsp;Show Profile</a></li>
                    <li><a href="{{route('admin.edit',Auth::user()->id)}}" class="list-group-item mt-2 sidebar-dropdown-item" ><i class="fa fa-pencil-square-o"></i> &nbsp;Edit Profile</a></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                         class="list-group-item mt-2 sidebar-dropdown-item" ><i class="fa fa-sign-out"></i> &nbsp;{{ __('Logout') }}
                         <form id="logout-form" action="{{ route('logout') }}" method="POST"
                         class="d-none">
                         @csrf
                        </form>    
                        </a>
                    </li>
                  </ul>
                </div>
            </a>            
        </ul>
    </div>

    <div class="content">
        <!-- content of other pages here... -->
        @yield("content")
    </div>

<!-- alerts.js -->
 <script src="{{ asset("js/alerts.js") }}"></script>
<!-- index.js  -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ asset("js/index.js") }}"></script>
</body>
</html>