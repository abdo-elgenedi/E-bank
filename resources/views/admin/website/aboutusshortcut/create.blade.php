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
      <form class="text-center border border-light card  pl-5 pr-5 pt-2 pb-5 m-auto" method="POST" style="width:50%" action="{{route('admin.aboutusshortcut.store')}}" enctype="multipart/form-data">
        @csrf
        <p style="text-align: left">
          <a href="{{route('admin.aboutusshortcut.index')}}" target="_self"><i class="fa fa-angle-left "></i> Back</a>
        </p>

        <p class="h4 mb-2 p-2 card bg-blue">Add New About us Shortcut</p>


          <div class="form-group mt-0">
              <label class="float-left required" for="name">Header Head</label>
              <input type="text"  class="form-control @error('head') is-invalid @enderror" id="head" name="head" placeholder="Enter Header Head" value="{{ old('head') }}">
              @error('head')
              <p class="form-text text-red mb-0">{{$message}}.</p>
              @enderror()
          </div>

          <div class="form-group mt-0">
              <label class="float-left required" for="website">Paragraph</label>
              <textarea type="text" class="form-control @error('paragraph') is-invalid @enderror paragraph" id="paragraph" name="paragraph" placeholder="Enter Header paragraph" style="min-height: 100px; max-height: 200px">{{ old('paragraph') }}</textarea>
              <span id="chars"></span>
              @error('paragraph')
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
  <script>
      window.onlaod=function () {
          var maxLength = 100;
          $('#paragraph').keyup(function() {
              var length = $(this).val().length;
              var length = maxLength-length;
              $('#chars').text(length);
          });
      }
  </script>
@endsection

