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
      <form class="text-center border border-light card  pl-5 pr-5 pt-2 pb-5 m-auto" method="POST" style="width:50%" action="{{route('admin.gallery.store')}}" enctype="multipart/form-data">
        @csrf
        <p style="text-align: left">
          <a href="{{route('admin.gallery.index')}}" target="_self"><i class="fa fa-angle-left "></i> Back</a>
        </p>

        <p class="h4 mb-2 p-2 card bg-blue">Add New Image</p>

          <div class="form-group mt-0">
              <label class="float-left required" for="customFile">Image</label>
              <div class="custom-file">
                  <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="customFile">
                  <label class="custom-file-label" for="customFile">Select image</label>
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

