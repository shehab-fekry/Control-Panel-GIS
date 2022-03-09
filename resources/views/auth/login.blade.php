<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <%= pageTitle %>
    </title>
    <link rel="icon" href="{{ asset("assets/school-bus.png") }}">
    <link rel="stylesheet" href="{{ asset("css/SignUp.css") }}">
    <!--   Fonts   -->
    <link href="http://fonts.cdnfonts.com/css/cera-round-pro" rel="stylesheet">
    <!--  eye icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
</head>

<body>
    <div class="sign_wrapper">
            <div class="svg">
                <img src="{{ asset("assets/sginIn.svg") }}" width="500" height="500" alt="">
            </div>
            <div class="card">
                <div class="card_head">
                    <label> WELCOME</label>
                    <form class="getForm" action="{{ route('register') }}" method="GET">
                        <button class="toggle">JOIN US</button>
                    </form>
                </div>
                <form class="postForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="main_container">
                        <div class="input_container">
                            <div><img src="{{ asset("assets/email.png") }}"></div>
                            <input id="email" type="email" class="input_field @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                        <!-- message --> 
                        @error('email')
                        <div id="emailInvalid">  
                                {{ $message }}   
                    </div>
                    @enderror
                    </div>

                    <div class="main_container">
                        <div class="input_container">
                            <div><img src="{{ asset("assets/lock.png") }}"></div>
                            <input class="input_field" id="password" type="password" value="" placeholder="Password">
                            <i class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" onclick="toggle(this)"></i>
                        </div>
                        <!-- message -->
                        <div id="passInvalid">
                            @error('password')
                                        {{ $message }}
                                @enderror
                        </div>
                    </div>

                    <div class="other_input">
                        <div class="remember">
                            <input type="checkbox" id="remember" name="remember" value="yes">
                            <label for="remember">Remember Me</label>    
                        </div>
                        <div class="forget">
                            <a href="/dash/forgetPassword">Forget Password?</a>
                        </div>
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