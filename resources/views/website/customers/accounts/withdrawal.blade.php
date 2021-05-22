@extends('layouts.website')
@section('content')
    <section class="site-section">
        <div class="container" style="min-height: 300px">
            <form role="form" method="POST" action="{{ route('customer.accounts.withdrawalbalance') }}">
                @csrf
                <div class="card p-5" style="width: 70%;margin: auto">
                    <h2 class="header pb-5 text-center">Withdrawal</h2>
                    <div class="form-group row">
                        <label for="account" class="col-lg-3 col-form-label form-control-label">Account Number</label>
                        <div class="col-lg-6">
                            <select class="form-control" name="account" id="account">
                                @if(isset($accounts))
                                    @foreach($accounts as $account)
                                        <option value="{{$account->account_id}}">{{$account->account_id}} ({{$account->bank->name}})</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('account')
                            <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="amount" class="col-lg-3 col-form-label form-control-label">Amount</label>
                        <div class="col-lg-6">
                            <input class="form-control" type="number" value="" name="amount" id="amount" required>
                            @error('amount')
                            <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-lg-3 col-form-label form-control-label">Password</label>
                        <div class="col-lg-6">
                            <input class="form-control" type="password" value="" name="password" id="password" required>
                            @error('password')
                            <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label"></label>
                        <div class="col-lg-6 pt-4">
                            <input type="submit" class="btn btn-primary" value="Save Changes" style="width:100%;">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection