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
                    <div class="card-header">Verify Your Email Address.</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-8">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">

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



