<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome School Bus Tracking</title>
    <link rel="icon" href="{{ asset("assets/images/Logo-modified.png") }}">
    <!-- bootstarp -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--   Fonts   -->
    <link href="http://fonts.cdnfonts.com/css/cera-round-pro" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{ asset("css/home.css") }}" rel="stylesheet">
    <link href="{{ asset("js/css/SignIn.css") }}" rel="stylesheet" >
    <link rel="stylesheet" href="{{ asset("css/forHome.css") }}">


    <!-- Typed.js  -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <!--  Font Awesome  -->
    <script src="https://use.fontawesome.com/e8ca812c5b.js"></script>
</head>
<body> 

    {{-- <div class="nav">
        <div class="nav_leftside" style="padding:13px;">
            <div class="title">SchoolBusTracking</div>
        </div>
        <!-- <div class="paths">
            <a href=""><div>Sign In</div></a>
        </div> -->
    </div> --}}

    <div class="home_wrapper" style="background-color: #EEE;">
        <div class="homepage">
            <div class="home-container" style="min-height: auto;">
                <div class="home-design">
                    <div class="row">
                        <div class="col-sm-6 home-left-side">
                            <h1> Amazing School Bus Tracking System </h1>
                            <h5> Contact Us Now to Join our Family  Contact Us Now to Join our Family  Contact Us Now to Join our Family </h5>
                            <div class="typing">
                                <div class="text">
                                   <span class="pre-typing"> Our Features : <span class="cursor home-type"></span>
                                </div>
                            </div>
                            <div class="my-4">

                            </div>
                            @if (Route::has('login'))
                 <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="start-btn">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="start-btn">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="start-btn">Register</a>
                        @endif
                    @endauth
                </div>
                @endif
                            {{-- <a class="start-btn" href="{{ route("login") }}">Get Started</a> --}}
                          
                        
                        
                        </div>
                        <div class="col-sm-6 home-right-side">
                            <img src="{{ asset("assets/images/school-bus-home.png") }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="info_section">
                    <div class="statistics">
                        <div class="drivers" >
                            <div class="number">
                                <span id="plus">+</span><span class="counter" data-target="15">0</span>
                            </div>
                            <div class="label">
                                <div class="head">Drivers</div>
                                <div class="sublabel">In Service</div>
                            </div>
                        </div>
                        <div class="buses">
                            <div class="number">
                                <span id="plus">+</span><span class="counter" data-target="27">0</span>
                            </div>
                            <div class="label">
                                <div class="head">Buses</div>
                                <div class="sublabel">Ready To Go</div>
                            </div>
                        </div>
                        <div class="parents" >
                            <div class="number">
                                <span id="plus">+</span><span class="counter" data-target="38">0</span>
                            </div>
                            <div class="label">
                                <div class="head">Parents</div>
                                <div class="sublabel">Registered</div>
                            </div>
                        </div>
                        <div class="children">
                            <div class="number">
                                <span id="plus">+</span><span class="counter" data-target="73">0</span>
                            </div>
                            <div class="label">
                                <div class="head">Childrens</div>
                                <div class="sublabel">Being Picked</div>
                            </div>
                        </div>
                    </div>
                </div>
                
        </div>
    
        </div>
    
    </div>
    
    <!-- landingPage.js  -->
    <script src="{{ asset("js/landingPage.js") }}"></script>
</body>
</html>