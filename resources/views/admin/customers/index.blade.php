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
                                  <h6 class="text-bold"><b>age: </b> <i id="cardage"></i> </h6>
                                  <h6 class="text-bold text-aqua"><b>Balance: </b> <i id="cardbalance"></i> </h6>
                                  <h6 class="text-bold"><b>Created At: </b> <i id="cardcreatedat"></i> </h6>
                                  <h6 class="text-bold"><b>Created From: </b> <i id="cardcreatedfrom"></i> </h6>
                                  <h6 class="text-bold"><b>Status: </b> <b id="cardstatus"></b> </h6>
                              </div>
                              <div class="col-5 text-center">
                                  <img id="cardlogo" width="200" src="" alt="Customer Image" class="mt-3 img-fluid">
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
        <h2 class=" card card-header white-text text-center mx-3 bg-blue">Customers</h2>


      <!--/Card image-->

      <div class="px-4">


        <div class="table-wrapper">
          <!--Table-->
            <table id="example" class="table table-striped table-bordered hover" style="width:100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>username</th>
                    <th>email</th>
                    <th>balance</th>
                    <th>status</th>
                    <th>controls</th>
                    <th>Activation</th>
                </tr>
                </thead>
            <!--Table head-->

            <!--Table body-->
            <tbody>
            @if(isset($customers))
              @foreach($customers as $customer)
            <tr deletedid="{{$customer->id}}">
              <td>{{$customer->name}}</td>
              <td>{{$customer->username}}</td>
                <td>{{$customer->email}}</td>
                <td>{{$customer->balance}} $</td>
                <td statusactive="{{$customer->id}}" style="color: @if($customer->status=='0') red @else green @endif">@if($customer->status=='0')Not Active @else Active @endif</td>
                <td>
                  <div>
                  <a href="{{route('admin.customers.delete')}}" deleteid="{{$customer->id}}" class="customerdelete"  style="color:red;">
                    <i class="far fa-trash-alt mt-0"></i>
                  </a>
                  <a href="{{route('admin.customers.details')}}" detailstid="{{$customer->id}}" data-toggle="tooltip" title="Show Customer Details" detailsid="{{$customer->id}}" class="customerdetails m-1  btn-outline-white" style="color:green;">
                      <i class="far fa-eye mt-0"></i>
                  </a>
                </div>
              </td>
                <td>
                    <a href="{{route('admin.customers.changestatus')}}" activateid="{{$customer->id}}" class=" customeractivate btn btn-@if($customer->status=='0')primary @elseif($customer->status=='1')danger @endif  btn-sm px-2 m-0" style="color:white;">
                        @if($customer->status=='0')Activate
                        @elseif($customer->status=='1')Deactivate @endif
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

              $(document).on('click','.customerdelete',function (e) {
                  e.preventDefault();
                  if(confirm('Are You Sure To Delete This Customer !')) {
                      $.ajax({
                          type: 'post',
                          url: '{{route('admin.customers.delete')}}',
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


              $(document).on('click','.customeractivate',function (e) {
                  var button=this;
                  e.preventDefault();
                  $.ajax({
                      type:'post',
                      url:'{{route('admin.customers.changestatus')}}',
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
                                  $(button).attr('class', 'btn-sm px-2 customeractivate btn btn-' + data.btn);
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
              $(document).on('click','.customerdetails',function (e) {
                  e.preventDefault();

                  $.ajax({
                      type: 'post',
                      url: '{{route('admin.customers.details')}}',
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
                              $('#cardage').text(data.cardage);
                              $('#cardbalance').text(data.cardbalance);
                              $('#cardcreatedat').text(data.cardcreatedat);
                              $('#cardcreatedat').text(data.cardcreatedat);
                              $('#cardcreatedfrom').text(data.cardcreatedfrom);
                              $('#cardstatus').text(data.cardstatus).css('color',data.cardstatuscolor);
                              $('#cardlogo').attr('src','{{asset('images/customers')}}'+'/'+ data.cardlogo);
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
