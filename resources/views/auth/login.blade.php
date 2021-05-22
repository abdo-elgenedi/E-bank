<!doctype html>
<html lang="en">
<head>
    <title>E-bank &mdash; Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/website/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{asset('assets/website/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/website/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('assets/website/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/website/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/website/css/owl.theme.default.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/website/css/jquery.fancybox.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/website/css/bootstrap-datepicker.css')}}">

    <link rel="stylesheet" href="{{asset('assets/website/fonts/flaticon/font/flaticon.css')}}">

    <link rel="stylesheet" href="{{asset('assets/website/css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('assets/website/css/style.css')}}">

</head>
<body data-spy="scroll" data-offset="300">
<div class="site-blocks-cover overlay" style="background-image: url({{asset('assets/website/images/hero_2.jpg')}});" data-aos="fade" id="home-section">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 mt-5">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('login')}}" style="height: 300px">
                        @csrf
                        @error('message')
                        <div class="text-center"><h4 class="pb-1" style="color:red">{{$message}}</h4></div>
                        @enderror
                        <div class="form-group row">

                            <div class="col-md-12">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email address or phone number">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary"   style="width: 100%">
                                    Login
                                </button>
                                <div class="text-center">
                                    <a class="btn btn-link" style="text-align: center" href="{{ route('password.request') }}">
                                        Forgot Your Password?
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <a href="{{ route('register') }}" class="btn"style="width: 100%;background-color: #42b72a; color:whitesmoke; font-weight: bold">
                                    Create New Account
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="{{asset('assets/website/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('assets/website/js/jquery-ui.js')}}"></script>
<script src="{{asset('assets/website/js/popper.min.js')}}"></script>
<script src="{{asset('assets/website/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/website/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/website/js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('assets/website/js/jquery.easing.1.3.js')}}"></script>
<script src="{{asset('assets/website/js/aos.js')}}"></script>
<script src="{{asset('assets/website/js/jquery.fancybox.min.js')}}"></script>
<script src="{{asset('assets/website/js/jquery.sticky.js')}}"></script>
<script src="{{asset('assets/website/js/isotope.pkgd.min.js')}}"></script>


<script src="{{asset('assets/website/js/main.js')}}"></script>


</body>
</html>