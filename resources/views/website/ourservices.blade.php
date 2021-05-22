@extends('layouts.website')
@section('title')Services @endsection
@section('header') @include('website.includes.header') @endsection
@section('content')
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
@endsection