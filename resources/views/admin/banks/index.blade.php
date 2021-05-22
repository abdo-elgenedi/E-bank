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
                                  <h6 class="text-bold"><b>Id: </b> <i id="cardid"></i> </h6>
                                  <h6 class="text-bold"><b>Email: </b> <i id="cardemail"></i> </h6>
                                  <h6 class="text-bold"><b>Mobile: </b> <i id="cardmobile"></i> </h6>
                                  <h6 class="text-bold"><b>Website: </b> <i id="cardwebsite"></i> </h6>
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
        <h2 class=" card card-header white-text text-center mx-3 bg-blue">Banks</h2>


      <!--/Card image-->

      <div class="px-4">


        <div class="table-wrapper">
            <a href="{{route('admin.banks.create')}}" class=" btn bg-green text-bold m-2" style="font-size: 18px;">+ Add New Category</a>
          <!--Table-->
            <table id="example" class="table table-striped table-bordered hover" style="width:100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>mobile</th>
                    <th>status</th>
                    <th>image</th>
                    <th>controls</th>
                    <th>Activation</th>
                </tr>
                </thead>
            <!--Table head-->

            <!--Table body-->
            <tbody>
            @if(isset($banks))
              @foreach($banks as $bank)
            <tr deletedid="{{$bank->id}}">
              <td>{{$bank->name}}</td>
                <td>{{$bank->mobile}}</td>
                <td statusactive="{{$bank->id}}" style="color: @if($bank->status=='0') red @else green @endif">@if($bank->status=='0')Not Active @else Active @endif</td>

                <td><img src="{{asset('images/banks/'.$bank->image)}}" alt="{{$bank->name}} Bank" width="30" height="30" class="img-circle"></td>
              <td>
                  <div>
                  <a href="{{route('admin.banks.edit',$bank->id)}}" class="btn btn-outline-white btn-rounded btn-sm px-2" style="color:#007bff;">
                    <i class="fas fa-pencil-alt mt-0"></i>
                  </a>
                  <a href="{{route('admin.banks.delete')}}" deleteid="{{$bank->id}}" class="bankdelete"  style="color:red;">
                    <i class="far fa-trash-alt mt-0"></i>
                  </a>
                  <a href="{{route('admin.banks.details')}}" detailstid="{{$bank->id}}" data-toggle="tooltip" title="Show Vendor Details" detailsid="{{$bank->id}}" class="bankdetails m-1  btn-outline-white" style="color:green;">
                      <i class="far fa-eye mt-0"></i>
                  </a>
                </div>
              </td>
                <td>
                    <a href="{{route('admin.banks.changestatus')}}" activateid="{{$bank->id}}" class=" bankactivate btn btn-@if($bank->status=='0')primary @elseif($bank->status=='1')danger @endif  btn-sm px-2 m-0" style="color:white;">
                        @if($bank->status=='0')Activate
                        @elseif($bank->status=='1')Deactivate @endif
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

              $(document).on('click','.bankdelete',function (e) {
                  e.preventDefault();
                  if(confirm('Are You Sure To Delete This Bank !')) {
                      $.ajax({
                          type: 'post',
                          url: '{{route('admin.banks.delete')}}',
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


              $(document).on('click','.bankactivate',function (e) {
                  var button=this;
                  e.preventDefault();
                  $.ajax({
                      type:'post',
                      url:'{{route('admin.banks.changestatus')}}',
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
                                  $(button).attr('class', 'btn-sm px-2 bankactivate btn btn-' + data.btn);
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
              $(document).on('click','.bankdetails',function (e) {
                  e.preventDefault();

                  $.ajax({
                      type: 'post',
                      url: '{{route('admin.banks.details')}}',
                      data: {
                          'id': $(this).attr('detailsid'),
                          '_token':'{{csrf_token()}}'
                      },
                      success: function (data) {
                          if (data.show == true) {
                              $('#cardname').text(data.cardname);
                              $('#cardid').text(data.cardid);
                              $('#cardemail').text(data.cardemail);
                              $('#cardmobile').text(data.cardmobile);
                              $('#cardwebsite').text(data.cardwebsite);
                              $('#cardstatus').text(data.cardstatus).css('color',data.cardstatuscolor);
                              $('#cardlogo').attr('src','{{asset('images/banks')}}'+'/'+ data.cardlogo);
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
