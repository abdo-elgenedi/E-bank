@extends('layouts.admin')
@section('content')

  <div class="content-wrapper bg-white pt-1" style="min-height: 1416.81px;">

      @if(Session::has('success'))

          <!-- Modal -->
          <div class="modal fade" id="redirectionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header ">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body text-center {{Session::has('bg')?Session::get('bg'):''}}">
                          <h4>{{(Session::has('success'))?Session::get('success'):''}} <i class="fas {{(Session::has('fa'))?Session::get('fa'):''}}" style="color: {{(Session::has('color'))?Session::get('color'):''}}"></i></h4>
                      </div>
                      <div class="modal-footer ">
                          <button type="button" class="btn " data-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
          </div>
      @endif
      {{--This Modal For Ajax Code--}}
      <button type="button" id="success" class="btn btn-primary" style="display: none" data-toggle="modal" data-target="#exampleModal">
          Launch demo modal
      </button>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header ">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div id="messageid" class="modal-body text-center ">
                    <h4 id="message"></h4>
                  </div>
                  <div class="modal-footer ">
                      <button type="button" class="btn " data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>

    <div class="container bg-gradient-white pt-4">
    <!-- Table with panel -->
    <div class="card card-cascade narrower">


      <!--Card image-->
        <h2 class=" card card-header white-text text-center mx-3 bg-blue">Our Services</h2>


      <!--/Card image-->

      <div class="px-4">


        <div class="table-wrapper">
            <a href="{{route('admin.ourservices.create')}}" class=" btn bg-green text-bold m-2" style="font-size: 18px;">+ Add New Service</a>
          <!--Table-->
            <table id="example" class="table table-striped table-bordered hover" style="width:100%">
                <thead>
                <tr>
                    <th>Head</th>
                    <th>Paragraph</th>
                    <th>image</th>
                    <th>status</th>
                    <th>controls</th>
                    <th>Activation</th>
                </tr>
                </thead>
            <!--Table head-->

            <!--Table body-->
            <tbody>
            @if(isset($services))
              @foreach($services as $service)
            <tr deletedid="{{$service->id}}">
              <td>{{$service->head}}</td>
                <td>{{$service->paragraph}}</td>
                <td><img src="{{asset('images/ourservices/'.$service->image)}}" alt="{{$service->head}} Service" width="60" height="60" class="img-circle"></td>
                <td statusactive="{{$service->id}}" style="color: @if($service->status=='0') red @else green @endif">@if($service->status=='0')Not Active @else Active @endif</td>
              <td>
                  <div>
                  <a href="{{route('admin.ourservices.edit',$service->id)}}" class="btn btn-outline-white btn-rounded btn-sm px-2" style="color:#007bff;">
                    <i class="fas fa-pencil-alt mt-0"></i>
                  </a>
                  <a href="{{route('admin.ourservices.delete')}}" deleteid="{{$service->id}}" class="servicedelete"  style="color:red;">
                    <i class="far fa-trash-alt mt-0"></i>
                  </a>
                </div>
              </td>
                <td>
                    <a href="{{route('admin.ourservices.changestatus')}}" activateid="{{$service->id}}" class=" serviceactivate btn btn-@if($service->status=='0')primary @elseif($service->status=='1')danger @endif  btn-sm px-2 m-0" style="color:white;">
                        @if($service->status=='0')Activate
                        @elseif($service->status=='1')Deactivate @endif
                    </a>
                </td>
            </tr>

              @endforeach
              @endif
            </tbody>
            <!--Table body-->
          </table>
          <!--Table-->
        </div>

      </div>

    </div>
    <!-- Table with panel -->
  </div>
  </div>
  <!-- /.content-wrapper -->

      <script>
          window.onload = function(){
              $(document).ready(function() {
                  $('#example').DataTable();
              } );
              $('.dataTables_length').addClass('bs-select');

              if('{{Session::has('success')?'true':false}}'){
                  $('#redirectionModal').modal('show');
              }

              $(document).on('click','.servicedelete',function (e) {
                  e.preventDefault();
                  if(confirm('Are You Sure To Delete This Service !')) {
                      $.ajax({
                          type: 'post',
                          url: '{{route('admin.ourservices.delete')}}',
                          data: {
                              'id': $(this).attr('deleteid'),
                              '_token':'{{csrf_token()}}'
                          },
                          success: function (data) {
                              if (data.show == true) {
                                  $("#messageid").attr('class', data.bg + ' modal-body text-center ');
                                  $("#message").css("color", data.color);
                                  $('#message').text(data.message);
                                  if (data.deleted === true) {
                                      $("[deletedid=" + data.id + "]").hide();
                                  }
                                  document.getElementById('success').click();
                              }
                          },
                          error: function (reject) {

                          }
                      })
                  }
              });


              $(document).on('click','.serviceactivate',function (e) {
                  var button=this;
                  e.preventDefault();
                  $.ajax({
                      type:'post',
                      url:'{{route('admin.ourservices.changestatus')}}',
                      data:{
                          'id':$(this).attr('activateid'),
                          '_token':'{{csrf_token()}}'
                      },
                      success:function (data) {
                          if(data.show==true) {
                              $("#messageid").attr('class',data.bg+' modal-body text-center ');
                              $("#message").css("color", data.color);
                              $('#message').text(data.message);
                              if(data.action) {
                                  $(button).attr('class', 'btn-sm px-2 serviceactivate btn btn-' + data.btn);
                                  $(button).text(data.action);
                                  $("[statusactive=" + data.id + "]").text(data.status);
                                  $("[statusactive=" + data.id + "]").css('color', data.statuscolor);
                              }
                              document.getElementById('success').click();
                          }
                      },
                      error:function (reject) {

                      }
                  })
              });
          };

  </script>


@endsection
