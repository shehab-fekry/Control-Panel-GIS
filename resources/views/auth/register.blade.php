<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Sign Up
    </title>
    <link rel="icon" href="{{ asset("assets/images/Logo-modified.png")}}">
    <link rel="stylesheet" href="{{ asset("css/SignUp.css")}}">
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
                <img src="{{ asset("assets/images/registerDark.svg")}}" width="500" height="500" alt="">
            </div>
            <div class="card">
                <div class="card_head">
                    <label>SIGN UP</label>
                    <form class="getForm" action="{{ route('login') }}" method="GET">
                        <button class="toggle">SIGN IN</button>
                    </form>
                </div>
                <form onsubmit="validation()" class="postForm"  action="{{ route('register') }}"  method="POST">
                    @csrf
                    <div class="main_container">
                        <div class="input_container">
                            <div><img src="{{ asset("assets/images/user.png")}}"></div>
                            <input placeholder="Name" id="username" type="text" class="input_field @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        </div>
                        <!-- message -->
                        @error('name')
                        <div style="padding:2px; font-size:12px; color:red; margin-left:21px">{{ $message }}</div>
                        @enderror
                       
                    </div>

                    <div class="main_container">
                        <div class="input_container">
                            <div><img src="{{ asset("assets/images/email.png")}}"></div>
                            <input id="email" type="email" class="input_field @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Example@gmail.com">
                        </div>
                        <!-- message -->
                        @error('email')
                        <div style="padding:2px; font-size:12px; color:red; margin-left:21px">{{ $message }}</div>
                        @enderror
                        
                    </div>

                    <div class="main_container">
                        <div class="input_container">
                            <div><img src="{{ asset("assets/images/lock.png")}}"></div>
                            <input id="password" type="password" class="input_field form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                            <i class="bi bi-eye-slash" onclick="togglePass(this)"></i>
                        </div>
                        <!-- message -->
                        @error('password')
                     <div style="padding:2px; font-size:12px; color:red; margin-left:21px">{{ $message }}
                        {{-- @if ($message == "The password format is invalid.")
                        The password must be contains :
                        Require at least 8 characters
                        English uppercase characters (A – Z)
                        English lowercase characters (a – z)
                        at least one number (0 – 9)
                        @endif   --}}

                        </div>
                        {{-- <div id="passInvalid">{{ $message }}</div> --}}
                        @enderror
                    </div>
                    <div class="main_container">
                        <div class="input_container">
                            <div><img src="{{ asset("assets/images/lock.png")}}"></div>
                            <input class="input_field" id="confPassword"  type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                            <i class="bi bi-eye-slash" onclick="toggleConf(this)"></i>
                        </div>
                    </div>

                    <div class="select_container">
                        <div class="input_container">
                            <div class="select_text">You are:</div>
                            <select class="form-select form-control @error('is_admin') is-invalid @enderror" name="is_admin" required autocomplete="is_admin" aria-label="is_admin" name="is_admin">
                                <option value="1">Admin</option>
                                <option value="0">Clerk</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-end"></label>
                        <div class="col-md-6"> {!! htmlFormSnippet() !!} </div>
                        @if ($errors->has('g-recaptcha-response'))
                        <div class="col-md-6  text-md-end ">
                            <div style="font-size:12px; color:red;">Plesse Fill Out This Field</div>
                            {{-- <strong class="text-danger">Plesse Fill Out This Field</strong> --}}
                        </div>
                    @endif
                    </div>
                    
                    <button class="submit" type="submit">SIGN UP</button>
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


        // validation = () =>{
        //     const nameCheck = /^[A-Za-z. ]{5,20}$/
        //     // letters (capital or small), dott, space
        //     // min 5 inputs
        //     // max 20 input
        //     const emailCheck = /^[A-Za-z0-9_.-]{3,}@{1}[A-Za-z]{3,}.{1}[A-Za-z.]{3,}$/
        //     // letters (capital or small), digits, underscore, dott, dash
        //     // min 3 inputs
        //     // only one @
        //     // only one .
        //     const passwordCheck = /^(?=.*[0-9])(?=.*[!@#$%&*])[A-Za-z0-9!@#$%^&*]{8,20}$/
        //     // const confirmPasswordCheck = /^(?=.*[0-9])(?=.*[!@#$%&*])[A-Za-z0-9!@#$%^&*]{8,20}$/
        //     // letters (capital or small), digits, special characters
        //     // at least one digit
        //     // at least one special character

        //     const username = document.getElementById('username').value;
        //     const email = document.getElementById('email').value;
        //     const password = document.getElementById('password').value;
        //     const confirmPassword = document.getElementById('confPassword').value;

        //     if(nameCheck.test(username))
        //     {
        //         document.getElementById('username').style.borderBottom = '2px solid limegreen'
        //         document.getElementById('nameInvalid').innerHTML 
        //         = '<div style="padding:2px; font-size:12px; color:limegreen; margin-left:21px">Looks good!</div>'
        //     } else {
        //         document.getElementById('username').style.borderBottom = '2px solid red'
        //         document.getElementById('nameInvalid').innerHTML 
        //         = '<div style="padding:2px; font-size:12px; color:red; margin-left:21px">Invalid Input</div>'
        //     }

        //     if(emailCheck.test(email))
        //     {
        //         document.getElementById('email').style.borderBottom = '2px solid limegreen'
        //         document.getElementById('emailInvalid').innerHTML 
        //         = '<div style="padding:2px; font-size:12px; color:limegreen; margin-left:21px">Looks good!</div>'
        //     } else {
        //         document.getElementById('email').style.borderBottom = '2px solid red'
        //         document.getElementById('emailInvalid').innerHTML 
        //         = '<div style="padding:2px; font-size:12px; color:red; margin-left:21px">Invalid Input</div>'
        //     }

        //     if(passwordCheck.test(password))
        //     {
        //         document.getElementById('password').style.borderBottom = '2px solid limegreen'
        //         document.getElementById('passInvalid').innerHTML 
        //         = '<div style="padding:2px; font-size:12px; color:limegreen; margin-left:21px">Looks good!</div>'
        //     } else {
        //         document.getElementById('password').style.borderBottom = '2px solid red'
        //         document.getElementById('passInvalid').innerHTML 
        //         = '<div style="padding:2px; font-size:12px; color:red; margin-left:21px">Invalid Input</div>'
        //     }

        //     if(password === confirmPassword && confirmPassword !=='')
        //     {
        //         document.getElementById('confPassword').style.borderBottom = '2px solid limegreen'
        //         document.getElementById('confPassInvalid').innerHTML 
        //         = '<div style="padding:2px; font-size:12px; color:limegreen; margin-left:21px">Looks good!</div>'
        //     } else {
        //         document.getElementById('confPassword').style.borderBottom = '2px solid red'
        //         document.getElementById('confPassInvalid').innerHTML 
        //         = '<div style="padding:2px; font-size:12px; color:red; margin-left:21px">Passwords don\'t match</div>'
        //     }

        //     return nameCheck.test(username) && emailCheck.test(email) && passwordCheck.test(password) 
        //     && password === confirmPassword
        // }
    </script>
</body>
</html>