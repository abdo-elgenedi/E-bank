@extends('layouts.website')
@section('title')Home @endsection
@section('header') @include('website.includes.header') @endsection
@section('content')

    @if(Session::has('message'))

        <!-- Modal -->
        <div class="modal fade" id="redirectionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header ">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center" style="background-color: {{Session::get('color')}}">
                        <h4 style="color: white">{{Session::get('message')}}</h4>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn " data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="site-section cta-big-image" id="about-section">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="section-title mb-3" data-aos="fade-up" data-aos-delay="">About Us</h2>
                    <p class="lead" data-aos="fade-up" data-aos-delay="100">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus minima neque tempora reiciendis.</p>
                </div>
            </div>
            @if(isset($aboutusHeaders)&&$aboutusHeaders->count()>0)
                <div class="row">
                    @foreach($aboutusHeaders as $header)
                        <div class="col-lg-6 mb-5" data-aos="fade-up" data-aos-delay="">
                            <img src="{{asset('images/aboutus/'.$header->image)}}" alt="Free Website Template by Free-Template.co" class="img-fluid">
                        </div>
                        <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="100">

                            <h3 class="text-black mb-4">{{$header->head}}</h3>
                            <p>{{$header->paragraph}}</p>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
        @if(isset($aboutusShortcuts)&&$aboutusShortcuts->count()>0)
            <div class="site-section" id="next">
                <div class="container">
                    <div class="row mb-5">
                        @foreach($aboutusShortcuts as $shortcut)
                            <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="200">
                                <img src="{{asset('images/aboutus/'.$shortcut->image)}}" alt="Free Website Template by Free-Template.co" class="img-fluid w-25 mb-4">
                                <h3 class="card-title">{{$shortcut->head}}</h3>
                                <p>{{$shortcut->paragraph}}</p>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        @endif
    </div>
    @if(isset($galleries)&&$galleries->count()>0)
        <section class="site-section" id="gallery-section" data-aos="fade">
            <div class="container">

                <div class="row mb-3">
                    <div class="col-12 text-center">
                        <h2 class="section-title mb-3">Gallery</h2>
                    </div>
                </div>
                <div id="posts" class="row no-gutter">
                    @foreach($galleries as $gallery)
                        <div class="item web col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-4" data-fancybox="gallery2">
                            <a href="{{asset('images/gallery/'.$gallery->image)}}" class="item-wrap fancybox">
                                <span class="icon-search2"></span>
                                <img class="img-fluid" src="{{asset('images/gallery/'.$gallery->image)}}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @include('website.howitworks')
    @if(isset($ourServices)&&$ourServices->count()>0)
        <section class="site-section border-bottom bg-light" id="services-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center" data-aos="fade">
                        <h2 class="section-title mb-3">Our Services</h2>
                    </div>
                </div>
                <div class="row align-items-stretch">
                    @foreach($ourServices as $ourService)
                        <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up">
                            <div class="unit-4">
                                <div class="unit-4-icon">
                                    <img src="{{asset('images/ourservices/'.$ourService->image)}}" alt="Free Website Template by Free-Template.co" class="img-fluid w-25 mb-4">
                                </div>
                                <div>
                                    <h3>{{$ourService->head}}</h3>
                                    <p>{{$ourService->paragraph}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @if(isset($testimonials)&&$testimonials->count()>0)
        <section class="site-section testimonial-wrap" id="testimonials-section" data-aos="fade">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="section-title mb-3">Happy Customers</h2>
                    </div>
                </div>
            </div>
            <div class="slide-one-item home-slider owl-carousel">
                @foreach($testimonials as $testimonial)
                    <div>
                        <div class="testimonial">

                            <blockquote class="mb-5">
                                <p>&ldquo;{{$testimonial->opinion}}&rdquo;</p>
                            </blockquote>

                            <figure class="mb-4 d-flex align-items-center justify-content-center">
                                <div><img src="{{asset('images/customers/'.$testimonial->customer->image)}}" alt="Image" class="w-50 img-fluid mb-3"></div>
                                <p>{{$testimonial->customer->name}}</p>
                            </figure>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
    @if(isset($contactUs)&&$contactUs->count()>0)
        <section class="site-section bg-light" id="contact-section" data-aos="fade">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="section-title mb-3">Contact Us</h2>
                    </div>
                </div>
                <div class="row mb-5">



                    <div class="col-md-4 text-center">
                        <p class="mb-4">
                            <span class="icon-room d-block h2 text-primary"></span>
                            <span>{{$contactUs->address}}</span>
                        </p>
                    </div>
                    <div class="col-md-4 text-center">
                        <p class="mb-4">
                            <span class="icon-phone d-block h2 text-primary"></span>
                            <a href="">{{$contactUs->mobile}}</a>
                        </p>
                    </div>
                    <div class="col-md-4 text-center">
                        <p class="mb-0">
                            <span class="icon-mail_outline d-block h2 text-primary"></span>
                            <a href="https://mail.google.com/mail/u/0/?view=cm&fs=1&to={{$contactUs->email}};&tf=1" target="_blank">{{$contactUs->email}}</a>
                        </p>
                    </div>
                </div>
                @if($contactUs->form_status==1)
                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <form action="{{route('contact.us')}}" method="POST" class="p-5 bg-white">
                                @csrf
                                <h2 class="h4 text-black mb-5">Contact Form</h2>
                                <div class="row form-group">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label class="text-black" for="fname">First Name<span style="color: red">*</span></label>
                                        <input type="text" maxlength="20" name="f_name" id="fname" class="form-control @error('f_name') is-invalid @enderror()" value="{{old('f_name')}}" required>
                                        @error('f_name')
                                        <p class="text-red pl-3" style="color:red">{{$message}}</p>
                                        @enderror()
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-black" for="lname">Last Name<span style="color: red">*</span></label>
                                        <input type="text" maxlength="20" name="l_name" id="lname" class="form-control @error('l_name') is-invalid @enderror()" value="{{old('l_name')}}" required>
                                        @error('l_name')
                                        <p class="text-red pl-3" style="color:red">{{$message}}</p>
                                        @enderror()
                                    </div>
                                </div>
                                <div class="row form-group">

                                    <div class="col-md-12">
                                        <label class="text-black" for="email">Email<span style="color: red">*</span></label>
                                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror()" value="{{old('email')}}" required>
                                        @error('email')
                                        <p class="text-red pl-3" style="color:red">{{$message}}</p>
                                        @enderror()
                                    </div>
                                </div>
                                <div class="row form-group">

                                    <div class="col-md-12">
                                        <label class="text-black" for="subject">Subject<span style="color: red">*</span></label>
                                        <input type="text" maxlength="100" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror()" value="{{old('subject')}}" required>
                                        @error('subject')
                                        <p class="text-red pl-3" style="color:red">{{$message}}</p>
                                        @enderror()
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label class="text-black" for="message">Message<span style="color: red">*</span></label>
                                        <textarea name="message"  maxlength="512" id="message" cols="30" rows="7" class="form-control @error('message') is-invalid @enderror()" placeholder="Write your notes or questions here..." required>{{old('message')}}</textarea>
                                        @error('message')
                                        <p class="text-red pl-3" style="color:red">{{$message}}</p>
                                        @enderror()
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <input type="submit" value="Send Message" class="btn btn-primary btn-md text-white">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    @endif
    <script>
        window.onload=function () {
            if('{{Session::has('message')}}'){
                $('#redirectionModal').modal('show');
            }
        }

    </script>
@endsection