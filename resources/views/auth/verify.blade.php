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
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                A fresh verification link has been sent to your email address.
                            </div>
                        @endif

                            Before proceeding, please check your email for a verification link.
                            If you did not receive the email
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">click here to request another</button>.
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
