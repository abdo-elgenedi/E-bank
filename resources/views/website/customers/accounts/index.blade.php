@extends('layouts.website')
@section('content')
    <style>.img-wrap {
            position: relative;
        ...
        }
        .img-wrap .close {
            position: absolute;
            top: 0px;
            right: 50%;
            z-index: 100;
        ...
        }</style>

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
    <section class="site-section border-bottom bg-light pb-5" id="services-section">
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <a href="{{route('customer.accounts.withdrawal')}}" class="col-md-2 btn btn-success" style="color: #fff;">Withdrawal</a>
                <div class="col-md-2"></div>
                <a href="{{route('customer.accounts.deposit')}}" class="col-md-2 btn btn-success" style="color: #fff;">Deposit</a>
                <div class="col-md-2"></div>
                <a href="{{route('customer.accounts.add')}}" class="col-md-2 btn btn-success" style="color: #fff;">Link Account</a>
                <div class="col-md-3"></div>
            </div>
        </div>
    </section>


        <section class="site-section border-bottom bg-light pt-5" id="services-section">
            <h2 class="header pb-5 text-center">Your Accounts</h2>
            <div class="container">
                <div class="row align-items-stretch">
                    @if(isset($accounts)&&($accounts->count()>0))
                        @foreach($accounts as $account)
                        <div class="col-md-6 col-lg-4 mb-4 mb-lg-4 img-wrap" data-aos="fade-up">
                            <a href="{{route('customer.accounts.delete',$account->account_id)}}" onclick="if(!confirm('Are you sure to unlink this account?'))return false;" class="close">&times;</a>
                            <div class="unit-4">
                                <div class="unit-4-icon">
                                    <img src="{{asset('images/banks/'.$account->bank->image)}}" alt="Free Website Template by Free-Template.co" class="img-fluid w-25 mb-4">
                                </div>
                                <div>
                                    <h3>{{$account->account_id}}</h3>
                                    <p>{{$account->bank->name}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="text-center" style="width: 100%">
                        <h2 class="header">You doesn't have any linked account</h2>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    <script>
        window.onload=function () {
            if('{{Session::has('message')}}'){
            $('#redirectionModal').modal('show');
            }
        }

    </script>
@endsection