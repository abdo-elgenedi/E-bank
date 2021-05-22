@extends('layouts.website')
@section('content')
    <link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    @if(Session::has('message'))

        <!-- Modal -->
        <div class="modal fade" id="redirectionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header ">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center" style="background-color: {{Session::get('color')}}">
                        <h4 style="color: white">{{Session::get('message')}}</h4>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn " data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="mt-5" style="min-height:550px">
    <div class="container mt-lg-5 pt-5">
        <h2 style="text-align: center;color:green">Transactions</h2>

    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>Sender Name</th>
            <th>Receiver Name</th>
            <th>Amount</th>
            <th>status</th>
            <th>details</th>
            <th>Time</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($transactions))
            @foreach($transactions as $transaction)
        <tr>
            <td>{{$transaction->senders->name}}</td>
            <td>{{$transaction->receivers->name}}</td>
            <td>{{$transaction->amount}} $</td>
            <td style="color:@if($transaction->status=='1') green @else red @endif;">@if($transaction->status=='1') Succeeded @else Failed @endif</td>
            <td>{{$transaction->details}}</td>
            <td>{{$transaction->created_at}}</td>
        </tr>
            @endforeach
        @endif

        </tbody>
    </table>
    </div>
    </div>

    <script>
        window.onload=function(){
            if('{{Session::has('message')}}'){
                $('#redirectionModal').modal('show');
            }

            $(document).ready(function() {
                $('#example').DataTable();
            } );

        };

    </script>
@endsection