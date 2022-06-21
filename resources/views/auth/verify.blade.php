<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Confirm Email
    </title>
    <link rel="icon" href="{{ asset("assets/images/Logo-modified.png") }}">
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


        <div class="col-sm-12">
            <button class="btn logout-btn">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                    class="" ><i class="fa fa-sign-out"></i> &nbsp;{{ __('Logout') }}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                    class="d-none"></a>
             @csrf
            </button>
        </div>
    </form>


</div>


<div class="need-help">
    <div class="col-sm-12">
        <div class="row">
                <h3>Need Help? Please <strong><a href="mailto:bustracking.v0@gmail.com">Contact US</a></strong></h4>
        </div>
    </div>
</div>

</body>
</html>
