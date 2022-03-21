<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        email
    </title>
    <link rel="icon" href="{{ asset("assets/images/school-bus.png")}}">
    <link rel="stylesheet" href="{{ asset("css/forgetPassword.css")}}">
    <!--   Fonts   -->
    <link href="http://fonts.cdnfonts.com/css/cera-round-pro" rel="stylesheet">
</head>

<body>
    <div class="sign_wrapper">
        
        <div class="svg">
            <img src="{{ asset("assets/images/forgetPassDark.svg")}}" width="500" height="500" alt="">
        </div>
        <div class="card">
            <div class="card_head">
                <label> RESET PASSWORD</label>
            </div>
            @if (session('status'))
        <div>
            {{ session('status') }}
        </div>
        @endif
            <form class="postForm" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="main_container">
                    <div class="input_container">
                        <div><img src="{{ asset("assets/images/email.png")}}"></div>
                        <input id="email" type="email" class="input_field @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Example@gmail.com">
                    </div>
                    <!-- message -->
                    @error('email')
                    <div id="emailInvalid">{{ $message }}</div>
                    @enderror

                </div>
                <button class="submit" type="submit">{{ __('Send Password Reset Link') }}</button>
            </form>
        </div>
    </div>
    <script></script>
</body>

</html>
