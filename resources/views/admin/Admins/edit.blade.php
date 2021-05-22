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
      <form class="text-center border border-light card  pl-5 pr-5 pt-2 pb-5 m-auto" method="POST" style="width:50%" action="{{route('admin.banks.update')}}" enctype="multipart/form-data">
        @csrf
        <p style="text-align: left">
          <a href="{{route('admin.banks.index')}}" target="_self"><i class="fa fa-angle-left "></i> Back</a>
        </p>

        <p class="h4 mb-2 p-2  bg-blue">Edit <b>{{$admins->name}}</b> Bank</p>

          <div class="form-group">
              <label class="float-left required" for="id">Bank id</label>
              <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" name="id" placeholder="Enter bank id" value="{{$bank->id}}">
              @error('id')
              <p class="form-text text-red mb-0">{{$message}}.</p>
              @enderror()
          </div>

          <div class="form-group mt-0">
              <label class="float-left required" for="name">Bank name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter bank name" value="{{$bank->name}}">
              @error('name')
              <p class="form-text text-red mb-0">{{$message}}.</p>
              @enderror()
          </div>

          <div class="form-group mt-0">
              <label class="float-left" for="website">Website</label>
              <input type="text" class="form-control @error('website') is-invalid @enderror" id="website" name="website" placeholder="Enter bank website" value="{{$bank->website}}">
              @error('website')
              <p class="form-text text-red mb-0">{{$message}}.</p>
              @enderror()
          </div>

          <div class="form-group mt-0">
              <label class="float-left required" for="mobile">Mobile</label>
              <input type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" id="mobile" placeholder="Enter bank mobile" value="{{ $bank->mobile}}">
              @error('mobile')
              <p class="form-text text-red mb-0">{{$message}}.</p>
              @enderror()
          </div>

          <div class="form-group mt-0">
              <label class="float-left required" for="email">Email</label>
              <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter bank email" value="{{ $bank->email}}">
              @error('email')
              <p class="form-text text-red mb-0">{{$message}}.</p>
              @enderror()
          </div>

          <div class="form-group mt-0">
              <label class="float-left required" for="customFile">Image</label>
              <div class="custom-file">
                  <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="customFile">
                  <label class="custom-file-label" for="customFile">Select bank image</label>
              </div>
              @error('image')
              <p class="form-text text-red mb-0">{{$message}}.</p>
              @enderror()
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>


      </form>
      <!-- Default form subscription -->  </div>
  </div>
@endsection

