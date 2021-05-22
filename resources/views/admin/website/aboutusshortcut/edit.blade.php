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
      <form class="text-center border border-light card  pl-5 pr-5 pt-2 pb-5 m-auto" method="POST" style="width:50%" action="{{route('admin.aboutusshortcut.update')}}" enctype="multipart/form-data">
        @csrf
        <p style="text-align: left">
          <a href="{{route('admin.aboutusshortcut.index')}}" target="_self"><i class="fa fa-angle-left "></i> Back</a>
        </p>
        
        <p class="h4 mb-2 p-2  bg-blue">Edit <b>{{$shortcut->head}}</b> Shortcut</p>
          <div class="text-center">
          <img src="{{asset('images/aboutus/'.$shortcut->image)}}" width="150" height="150" alt="">
          </div>
          <input type="hidden" name="id" value="{{$shortcut->id}}">
          <div class="form-group">
              <label class="float-left required" for="id">Head</label>
              <input type="text" class="form-control @error('head') is-invalid @enderror" id="head" name="head" placeholder="Enter Header Head" value="{{$shortcut->head}}">
              @error('head')
              <p class="form-text text-red mb-0">{{$message}}.</p>
              @enderror()
          </div>

          <div class="form-group mt-0">
              <label class="float-left required" for="name">Paragraph</label>
              <textarea class="form-control @error('paragraph') is-invalid @enderror" id="paragraph" name="paragraph" placeholder="Enter paragraph" style="min-height:150px;">{{$shortcut->paragraph}}
              </textarea>
              @error('paragraph')
              <p class="form-text text-red mb-0">{{$message}}.</p>
              @enderror()
          </div>

          <div class="form-group mt-0">
              <label class="float-left required" for="customFile">Image</label>
              <div class="custom-file">
                  <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="customFile">
                  <label class="custom-file-label" for="customFile">Select Header image</label>
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

