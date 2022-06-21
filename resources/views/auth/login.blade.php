<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Log in
    </title> 
    <link rel="icon" href="{{ asset("assets/images/Logo-modified.png")}}">
    <link rel="stylesheet" href="{{ asset("css/SignIn.css") }}">
    <!--   Fonts   -->
    <link href="http://fonts.cdnfonts.com/css/cera-round-pro" rel="stylesheet">
    <!--  eye icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
</head>

<body>
    <div class="nav">
        <div class="nav_leftside">
            <a href="/">
                <div class="return">
                    <img src="{{ asset("assets/images/arrowDark.png") }}" width="40px" height="40px">
                </div>
            </a>
            <div class="title">SchoolBusTracking</div>
        </div>
        <!-- <div class="paths">
            <a href=""><div>Sign In</div></a>
        </div> -->
    </div>
    <div class="sign_wrapper">
            <div class="svg">
                <img src="{{ asset("assets/images/sginIn.svg") }}" width="500" height="500" alt="">
            </div>
            <div class="card">
                <div class="card_head">
                    <label> WELCOME</label>
                    <form class="getForm" action="{{ route('register') }}">
                        <button class="toggle">JOIN US</button>
                    </form>
                </div>
                <form class="postForm"  action="{{ route('login') }}"  method="POST">
                    @csrf
                    <div class="main_container">
                        <div class="input_container">
                            <div><img src="{{ asset("assets/images/email.png") }}"></div>
                            <input class="input_field  @error('email') is-invalid @enderror" id="email" type="email" placeholder="Example@Example.com" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                        <!-- message --> 
                         @error('email') 
                         <div style="padding:2px; font-size:12px; color:red; margin-left:21px">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="main_container">
                        <div class="input_container">
                            <div><img src="{{ asset("assets/images/lock.png") }}"></div>
                            <input class="input_field  @error('password') is-invalid @enderror"id="password" type="password" name="password" required autocomplete="current-password">
                            <i class="bi bi-eye-slash" onclick="toggle(this)"></i>
                        </div>
                        <!-- message -->
                        @error('password')
                        <div style="padding:2px; font-size:12px; color:red; margin-left:21px">{{ $message }}</div> 
                        @enderror
                        
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-end"></label>
                        <div class="col-md-6"> {!! htmlFormSnippet() !!} </div>
                        @if ($errors->has('g-recaptcha-response'))
                        <div class="col-md-6  text-md-end ">
                         <div style="padding:2px; font-size:12px; color:red;">Plesse Fill Out This Field</div>
                        </div>
                    @endif
                    </div>

                    <div class="other_input">
                        <div class="remember">
                            <input class="checkbox" type="checkbox" id="remember" name="remember" value="yes"  {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">Remember Me</label>    
                        </div>

                        @if (Route::has('password.request'))
                        <div class="forget">
                            <a href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
                        </div>
                        @endif
                    </div>
                    <button class="submit" type="submit">SIGN IN</button>
                </form>
            </div>
    </div>
    <script>
        
        toggle = (eye) =>{
            let pass = document.getElementById("password");
            
            // change input type
            let type = pass.getAttribute("type") === "password" ? "text" : "password"
            pass.setAttribute("type", type)
            
            // toggle between bi-eye and bi-eye-slash
            eye.classList.toggle("bi-eye");
        }
    </script>
</body>
</html>