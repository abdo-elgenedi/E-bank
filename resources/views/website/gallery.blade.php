@extends('layouts.website')
@section('title')Gallery @endsection
@section('header') @include('website.includes.header') @endsection
@section('content')
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
@endsection
