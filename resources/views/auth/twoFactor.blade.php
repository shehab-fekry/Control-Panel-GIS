<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            Two Factor
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


<div class="row justify-content-center" style="margin-top:100px;">
    <div class="col-md-8">
        <div class="card-group">
            <div class="card p-4" style=" border-radius:20px;">
                <div class="card-body">
                    @if(session()->has('message'))
                        <p class="alert alert-info">
                            {{ session()->get('message') }}
                        </p>
                    @endif
                    <form method="POST" action="{{ route('verify.store') }}">
                        {{ csrf_field() }}
                        <h1>Two Factor Verification</h1>
                        <p class="text-muted">
                            You have received an email which contains two factor login code.
                            If you haven't received it, press <a href="{{ route('verify.resend') }}">here</a>.
                        </p>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-lock"></i>
                                </span>
                            </div>
                            <input name="two_factor_code" type="text" class="form-control{{ $errors->has('two_factor_code') ? ' is-invalid' : '' }}" required autofocus placeholder="Two Factor Code">
                            @if($errors->has('two_factor_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('two_factor_code') }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-2">
                                <button type="submit" class="btn btn-warning px-4">
                                    Verify
                                </button>
                            </div>
                            <div class="col-2 text-right">
                                <a class="btn btn-danger px-4" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                    {{ trans('logout') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
</html>
