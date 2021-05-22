@extends('layouts.admin')
@section('content')
  <style>
    .input-group-prepend{width:35%;}
    .input-group-text{width:100%;}
    .darkblue{background-color:darkblue;color:white}
    .required:after {
        content:"*";
        color:red;
    }
  </style>
  <div class="content-wrapper" style="min-height: 1416.81px;">
    <div class="container bg-gradient-white card-body">
      <!-- Default form subscription -->
      <form class="text-center border border-light card  pl-5 pr-5 pt-2 pb-5 m-auto" method="POST" style="width:50%" action="{{route('admin.admins.store')}}" enctype="multipart/form-data">
        @csrf
        <p style="text-align: left">
          <a href="{{route('admin.admins.index')}}" target="_self"><i class="fa fa-angle-left "></i> Back</a>
        </p>

        <p class="h4 mb-2 p-2 card bg-blue">Add New Admin</p>

          <div class="form-group mt-0">
              <label class="float-left required" for="name">name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter admin name" value="{{ old('name') }}">
              @error('name')
              <p class="form-text text-red mb-0">{{$message}}.</p>
              @enderror()
          </div>

          <div class="form-group mt-0">
              <label class="float-left required" for="username">Username</label>
              <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Enter admin username" value="{{ old('username') }}">
              @error('username')
              <p class="form-text text-red mb-0">{{$message}}.</p>
              @enderror()
          </div>

          <div class="form-group mt-0">
              <label class="float-left required" for="mobile">Mobile</label>
              <input type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" id="mobile" placeholder="Enter admin mobile" value="{{ old('mobile') }}">
              @error('mobile')
              <p class="form-text text-red mb-0">{{$message}}.</p>
              @enderror()
          </div>

          <div class="form-group mt-0">
              <label class="float-left required" for="email">Email</label>
              <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter admin email" value="{{ old('email') }}">
              @error('email')
              <p class="form-text text-red mb-0">{{$message}}.</p>
              @enderror()
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>


      </form>
      <!-- Default form subscription -->  </div>
  </div>
@endsection

