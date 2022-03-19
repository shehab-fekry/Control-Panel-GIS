{{-- 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<!DOCTYPE html> 
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Confirm Email
    </title>
    <link rel="icon" href="{{ asset("assets/images/tracking.svg") }}">
    <!-- bootstarp -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--   Fonts   -->
    <link href="http://fonts.cdnfonts.com/css/cera-round-pro" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{ asset("css/layout.css") }}" rel="stylesheet">
    <link href="{{ asset("css/confirmEmail.css") }}" rel="stylesheet">
    <link href="{{ asset("css/home.css") }}" rel="stylesheet">
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <!--   Axios   -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://use.fontawesome.com/e8ca812c5b.js"></script>

</head>

<body>
<div class="top-back">
    
</div>

<div class="confirm-email">
    <h1> {{ __('Confirm Your Email') }}    </h1>
    <img src="{{ asset("assets/images/Ok-amico.png") }}" class="confirm-img">
    <P>Before proceeding, please check your email for a verification link. </P>
    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="confirm-btn">{{ __('request another') }}</button>
    </form>
    
        @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
        @endif
       
</div>

<div class="need-help">
    <h3>Need Help? Please <strong><a href="#">Contact US</a></strong></h4>
</div>

</body>
</html> 