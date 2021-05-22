@extends('layouts.website')
@section('title')About @endsection
@section('header') @include('website.includes.header') @endsection
@section('content')
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
    @endsection

