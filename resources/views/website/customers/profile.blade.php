@extends('layouts.website')
@section('content')
    <link rel="stylesheet" href="{{asset('assets/website/css/profile.css')}}">
    <!------ Include the above in your HEAD tag ---------->
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

        <div class="content-wrapper bg-white mt-5" style="min-height:600px;">
            <div class="container pt-4 mt-5">
                <div class="row my-2">
                    <div class="col-lg-8 order-lg-2">
                        <div class="profile-head">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit" aria-selected="false">Edit</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="passwords-tab" data-toggle="tab" href="#passwords" role="tab" aria-controls="passwords" aria-selected="false">Passwords</a>
                            </li>
                        </ul>
                        </div>
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="home-tab">
                                <h4 class="mb-3" style="font-weight: bold">{{Auth::user()->name}}</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        @if(Session::has('success'))
                                            <span class="btn btn-{{Session::get('style')}}" role="alert">
                                    <strong>{{Session::get('success')}}</strong>
                                    </span>
                                        @endif
                                            <div class="n In-md-8">
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label>name</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <p>{{Auth::user()->name}}</p>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label>Username</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <p>{{Auth::user()->username}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="col-md-3">
                                                                <label>Email</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <p>{{Auth::user()->email}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="col-md-3">
                                                                <label>Mobile</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <p>{{Auth::user()->mobile}}</p>
                                                            </div>

                                                        </div>
                                                        <div class="row">

                                                            <div class="col-md-3">
                                                                <label>Age</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <p>{{Auth::user()->age}} Years old</p>
                                                            </div>

                                                        </div>
                                                        <div class="row">

                                                            <div class="col-md-3">
                                                                <label>Balance</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <p>{{Auth::user()->balance}} $</p>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label>Signed up</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                {{Auth::user()->created_at}}&emsp;<span class="alert-danger p-2">From{{" ( ".Auth::user()->created_at->diffForHumans()." ) "}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <!--/row-->
                            </div>
                            <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="profile-tab">
                                <form role="form" method="POST" action="{{ route('customer.profile.update') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="name" class="col-lg-3 col-form-label form-control-label">Name</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" value="{{Auth::user()->name}}" name="name" id="name" >
                                            @error('name')
                                                <span class="alert-danger" role="alert">
                                                     <strong>{{$message}}</strong>
                                                 </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="username" class="col-lg-3 col-form-label form-control-label">Username</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" value="{{Auth::user()->username}}" name="username" id="username" required>
                                            @error('username')
                                            <span class="alert-danger" role="alert">
                                                 <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-lg-3 col-form-label form-control-label">Email</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="email" value="{{Auth::user()->email}}" name="email" id="email" required>
                                            @error('email')
                                            <span class="alert-danger" role="alert">
                                               <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mobile" class="col-lg-3 col-form-label form-control-label">Mobile</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" value="{{Auth::user()->mobile}}" name="mobile" id="mobile" required>
                                            @error('mobile')
                                                <span class="alert-danger" role="alert">
                                                     <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="age" class="col-lg-3 col-form-label form-control-label">Age</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="number" value="{{Auth::user()->age}}" name="age" id="age" placeholder="Enter Your Age">
                                            @error('age')
                                                <span class="alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-lg-3 col-form-label form-control-label">Password</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="password" value="" name="password" id="password" placeholder="Enter Your Password For Confirmation">
                                            @error('password')
                                            <span class="alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"></label>
                                        <div class="col-lg-9">
                                            <input type="submit" class="btn btn-primary" value="Save Changes">
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="passwords" role="tabpanel" aria-labelledby="profile-tab">
                                <form role="form" method="POST" action="{{ route('customer.profile.password') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="oldpassword" class="col-lg-3 col-form-label form-control-label">Old Password</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="password" name="oldpassword" id="oldpassword" required>
                                            @error('oldpassword')
                                            <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="newpassword" class="col-lg-3 col-form-label form-control-label">New Password</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="password" name="password" id="newpassword" required>
                                            @error('password')
                                            <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password_confirmation" class="col-lg-3 col-form-label form-control-label">Confirm Password</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required>
                                            @error('password_confirmation')
                                            <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"></label>
                                        <div class="col-lg-9">
                                            <input type="submit" class="btn btn-primary" value="Save Changes">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 order-lg-1 text-center">
                        <form class="mb-3" method="POST" action="{{route('customer.profile.photo')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="profile-img">
                                <img src="{{asset('images/customers/'.Auth::user()->image)}}" alt=""/>
                                <div class="file btn btn-lg btn-primary">
                                    Change Photo
                                    <input type="file" name="image"/>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger mt-3">&nbsp; Save &nbsp;</button>
                        </form>
                        @error('image')
                        <span class="text-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                        @enderror
                    </div>
                </div>
            </div>
    </div>
    <script>
        window.onload=function () {
            if('{{Session::has('message')}}'){
                $('#redirectionModal').modal('show');
            }
        }
    </script>
@endsection