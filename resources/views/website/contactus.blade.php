@extends('layouts.website')
@section('title')Contact @endsection
@section('header') @include('website.includes.header') @endsection
@section('content')
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
@endsection

