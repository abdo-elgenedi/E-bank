@extends('layouts.website')
@section('title')Testimonials @endsection
@section('header') @include('website.includes.header') @endsection
@section('content')
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
@endsection