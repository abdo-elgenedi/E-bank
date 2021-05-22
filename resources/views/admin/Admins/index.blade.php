@extends('layouts.admin')
@section('content')

  <div class="content-wrapper bg-white pt-1" style="min-height: 1416.81px;">

      <div class="modal fade" id="vendordetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div>
                  <div class="card bg-dark">
                      <div class="card-body pt-2">
                          <div class="row">
                              <div class="col-7">
                                  <h2 class=""><b class="text-cyan text-bold" id="cardname"></b></h2>
                                  <h6 class="text-bold"><b>Username: </b> <i id="cardusername"></i> </h6>
                                  <h6 class="text-bold"><b>Email: </b> <i id="cardemail"></i> </h6>
                                  <h6 class="text-bold"><b>Mobile: </b> <i id="cardmobile"></i> </h6>
                                  <h6 class="text-bold"><b>Status: </b> <b id="cardstatus"></b> </h6>
                              </div>
                              <div class="col-5 text-center">
                                  <img id="cardlogo" width="200" src="" alt="Bank Logo" class="mt-3 img-fluid">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      {{--This Modal For Deletion--}}
      <!-- Modal -->
          <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header ">
                      </div>
                      <div class="modal-body text-center bg-red">
                          <h4>Are You Sure To Delete This Record <i class="fas fa-exclamation" style="color:white"></i></h4>
                      </div>
                      <div class="modal-footer ">
                          <button type="button" class="btn btn-danger" onclick="confirmdelete()" data-dismiss="modal">Delete</button>
                          <button type="button" class="btn btn-primary" onclick="confirm='false'" data-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
          </div>
      {{--This Modal For Redirection--}}
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
        <h2 class=" card card-header white-text text-center mx-3 bg-blue">Admins</h2>


      <!--/Card image-->

      <div class="px-4">


        <div class="table-wrapper">
            <a href="{{route('admin.admins.create')}}" class=" btn bg-green text-bold m-2" style="font-size: 18px;">+ Add New Admin</a>
          <!--Table-->
            <table id="example" class="table table-striped table-bordered hover" style="width:100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>username</th>
                    <th>email</th>
                    <th>mobile</th>
                    <th>status</th>
                    <th>controls</th>
                    <th>Activation</th>
                </tr>
                </thead>
            <!--Table head-->

            <!--Table body-->
            <tbody>
            @if(isset($admins))
              @foreach($admins as $admin)
            <tr deletedid="{{$admin->id}}">
              <td>{{$admin->name}}</td>
              <td>{{$admin->username}}</td>
              <td>{{$admin->email}}</td>
                <td>{{$admin->mobile}}</td>
                <td statusactive="{{$admin->id}}" style="color: @if($admin->status=='0') red @else green @endif">@if($admin->status=='0')Not Active @else Active @endif</td>
                <td>
                  <div>
                  <a href="{{route('admin.admins.delete')}}" deleteid="{{$admin->id}}" class="admindelete"  style="color:red;">
                    <i class="far fa-trash-alt mt-0"></i>
                  </a>
                  <a href="{{route('admin.admins.details')}}" detailstid="{{$admin->id}}" data-toggle="tooltip" title="Show Vendor Details" detailsid="{{$admin->id}}" class="admindetails m-1  btn-outline-white" style="color:green;">
                      <i class="far fa-eye mt-0"></i>
                  </a>
                </div>
              </td>
                <td>
                    <a href="{{route('admin.admins.changestatus')}}" activateid="{{$admin->id}}" class=" adminactivate btn btn-@if($admin->status=='0')primary @elseif($admin->status=='1')danger @endif  btn-sm px-2 m-0" style="color:white;">
                        @if($admin->status=='0')Activate
                        @elseif($admin->status=='1')Deactivate @endif
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

              $(document).on('click','.admindelete',function (e) {
                  e.preventDefault();
                  if(confirm('Are You Sure To Delete This Admin !')) {
                      $.ajax({
                          type: 'post',
                          url: '{{route('admin.admins.delete')}}',
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


              $(document).on('click','.adminactivate',function (e) {
                  var button=this;
                  e.preventDefault();
                  $.ajax({
                      type:'post',
                      url:'{{route('admin.admins.changestatus')}}',
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
                                  $(button).attr('class', 'btn-sm px-2 adminactivate btn btn-' + data.btn);
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
              $(document).on('click','.admindetails',function (e) {
                  e.preventDefault();

                  $.ajax({
                      type: 'post',
                      url: '{{route('admin.admins.details')}}',
                      data: {
                          'id': $(this).attr('detailsid'),
                          '_token':'{{csrf_token()}}'
                      },
                      success: function (data) {
                          if (data.show == true) {
                              $('#cardname').text(data.cardname);
                              $('#cardusername').text(data.cardusername);
                              $('#cardemail').text(data.cardemail);
                              $('#cardmobile').text(data.cardmobile);
                              $('#cardstatus').text(data.cardstatus).css('color',data.cardstatuscolor);
                              $('#cardlogo').attr('src','{{asset('images/admins')}}'+'/'+ data.cardlogo);
                              $('#vendordetails').modal('show');
                          }
                      },
                      error: function (reject) {

                      }
                  })
              });
          };

  </script>


@endsection
