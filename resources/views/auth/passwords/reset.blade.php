<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
       reset
    </title>
    <link rel="icon" href="{{ asset("assets/images/Logo-modified.png")}}">
    <link rel="stylesheet" href="{{ asset("css/newPassword.css")}}">
    <!--   Fonts   -->
    <link href="http://fonts.cdnfonts.com/css/cera-round-pro" rel="stylesheet">
    <!--  eye icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
</head>

<body>
    <div class="nav">
        <div class="nav_leftside">
            <a href="{{ route('home') }}">
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
                <img src="{{ asset("assets/images/ConfirmedDark.svg")}}" width="500" height="500" alt="">
            </div>
            <div class="card">
                <div class="card_head">
                    <label> NEW PASSWORD</label>
                </div>
                <form onsubmit="return validation()" class="postForm" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input id="email" type="hidden" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    <div class="main_container">
                        <div class="input_container">
                            <div><img src="{{ asset('assets/images/lock.png') }}"></div>
                            <input id="password" type="password" class="input_field @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                            <i class="bi bi-eye-slash" onclick="togglePass(this)"></i>
                        </div>
                        <!-- message -->
                        @error('password')
                        <div id="passInvalid">{{ $message }}</div>
                         @enderror
                        
                    </div>

                    <div class="main_container">
                        <div class="input_container">
                            <div><img src="{{ asset('assets/images/lock.png') }}"></div>
                            <input class="input_field" id="confPassword" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                            <i class="bi bi-eye-slash" onclick="toggleConf(this)"></i>
                        </div>
                    </div>
                    <button class="submit" type="submit">CHANGE</button>
                </form>
            </div>
    </div>
    <script>
        togglePass = (element) =>{
            let pass = document.getElementById("password");
            
            // change input type
            let type = pass.getAttribute("type") === "password" ? "text" : "password"
            pass.setAttribute("type", type)

            // toggle between bi-eye and bi-eye-slash
            element.classList.toggle("bi-eye");
        }

        toggleConf = (element) =>{
            let confPass = document.getElementById("confPassword");
            
            // change input type
            let type = confPass.getAttribute("type") === "password" ? "text" : "password"
            confPass.setAttribute("type", type)

            // toggle between bi-eye and bi-eye-slash
            element.classList.toggle("bi-eye");
        }


        validation = () => {
            const passwordCheck = /^(?=.*[0-9])(?=.*[!@#$%&*])[A-Za-z0-9!@#$%^&*]{8,20}$/
            // letters (capital or small), digits, special characters
            // at least one digit
            // at least one special character

            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confPassword').value;

            if(passwordCheck.test(password))
            {
                document.getElementById('password').style.borderBottom = '2px solid limegreen'
                document.getElementById('passInvalid').innerHTML 
                = '<div style="padding:2px; font-size:12px; color:limegreen; margin-left:21px">Looks good!</div>'
            } else {
                document.getElementById('password').style.borderBottom = '2px solid red'
                document.getElementById('passInvalid').innerHTML 
                = '<div style="padding:2px; font-size:12px; color:red; margin-left:21px">Invalid Input</div>'
            }

            if(password === confirmPassword && confirmPassword !=='')
            {
                document.getElementById('confPassword').style.borderBottom = '2px solid limegreen'
                document.getElementById('confPassInvalid').innerHTML 
                = '<div style="padding:2px; font-size:12px; color:limegreen; margin-left:21px">Looks good!</div>'
            } else {
                document.getElementById('confPassword').style.borderBottom = '2px solid red'
                document.getElementById('confPassInvalid').innerHTML 
                = '<div style="padding:2px; font-size:12px; color:red; margin-left:21px">Passwords don\'t match</div>'
            }

            return passwordCheck.test(password) && password === confirmPassword
        }
    </script>
</body>
</html>



{{--                      
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

