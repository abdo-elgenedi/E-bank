@extends('layouts.admin')
@section('content')

  <div class="content-wrapper bg-white pt-1" style="min-height: 1416.81px;">


    <div class="container bg-gradient-white pt-4">
    <!-- Table with panel -->
    <div class="card card-cascade narrower">


      <!--Card image-->
        <h2 class=" card card-header white-text text-center mx-3 bg-blue">Transactions</h2>


      <!--/Card image-->

      <div class="px-4">


        <div class="table-wrapper">
          <!--Table-->
            <table id="example" class="table table-striped table-bordered hover" style="width:100%">
                <thead>
                <tr>
                    <th>Sender id</th>
                    <th>sender name</th>
                    <th>receiver id</th>
                    <th>receiver name</th>
                    <th>amount</th>
                    <th>status</th>
                    <th>date</th>
                </tr>
                </thead>
            <!--Table head-->

            <!--Table body-->
            <tbody>
            @if(isset($transactions))
              @foreach($transactions as $transaction)
            <tr>
                <td>{{$transaction->sender_id}}</td>
              <td>{{$transaction->senders->name}}</td>
                <td>{{$transaction->receiver_id}}</td>
                <td>{{$transaction->receivers->name}}</td>
                <td>{{$transaction->amount}} $</td>
                <td style="color: @if($transaction->status=='0') red @else green @endif">@if($transaction->status=='0')Failed @else Successful @endif</td>
                <td>{{$transaction->created_at}}</td>
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
          };

  </script>


@endsection
