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
<body >
<div class="site-blocks-cover overlay" style="background-image: url({{asset('assets/website/images/hero_2.jpg')}});min-height: 800px" data-aos="fade" id="home-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 mt-5 mb-5">
                <div class="card">
                    <div class="card-header">Register</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('register')}}" style="min-height: 300px">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="name" type="text" placeholder="Enter your name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>
                                    @error('name')
                                    <p class="form-text bg-danger mb-0"> {{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="username" type="text" placeholder="Enter your username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autofocus>
                                    @error('username')
                                    <p class="form-text bg-danger mb-0"> {{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="email" type="text" placeholder="Enter your email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autofocus>
                                    @error('email')
                                    <p class="form-text bg-danger mb-0">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="mobile" type="text" placeholder="Enter your mobile number" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" autofocus>
                                    @error('mobile')
                                    <p class="form-text bg-danger mb-0">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="age" type="text" placeholder="Enter your age" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" autofocus>
                                    @error('age')
                                    <p class="form-text bg-danger mb-0"> {{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="password" type="password" placeholder="Enter password" class="form-control @error('password') is-invalid @enderror" name="password" autofocus>
                                    @error('password')
                                    <p class="form-text bg-danger mb-0"> {{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="password_confirmation" placeholder="Confirm password" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" autofocus>
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" style="width: 100%">
                                        Register
                                    </button>
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
