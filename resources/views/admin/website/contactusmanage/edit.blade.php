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
      <form class="text-center border border-light card  pl-5 pr-5 pt-2 pb-5 m-auto" method="POST" style="width:50%" action="{{route('admin.contactusmanage.update')}}" enctype="multipart/form-data">
        @csrf
        <p style="text-align: left">
          <a href="{{route('admin.contactusmanage.index')}}" target="_self"><i class="fa fa-angle-left "></i> Back</a>
        </p>
        
        <p class="h4 mb-2 p-2  bg-blue">Edit Contact Us</p>
          <div class="form-group">
              <label class="float-left required" for="id">Address</label>
              <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Enter address" value="{{$details->address}}">
              @error('address')
              <p class="form-text text-red mb-0">{{$message}}.</p>
              @enderror()
          </div>

          <div class="form-group">
              <label class="float-left required" for="id">Mobile</label>
              <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" placeholder="Enter mobile" value="{{$details->mobile}}">
              @error('mobile')
              <p class="form-text text-red mb-0">{{$message}}.</p>
              @enderror()
          </div>

          <div class="form-group">
              <label class="float-left required" for="id">Email</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email" value="{{$details->email}}">
              @error('email')
              <p class="form-text text-red mb-0">{{$message}}.</p>
              @enderror()
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>


      </form>
      <!-- Default form subscription -->  </div>
  </div>
@endsection

