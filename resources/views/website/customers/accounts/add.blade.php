@extends('layouts.website')
@section('content')
    <section class="site-section">
        <div class="container" style="min-height: 300px">
            <form role="form" method="POST" action="{{ route('customer.accounts.addAccount') }}">
                @csrf
                <div class="card p-5" style="width: 70%;margin: auto">
                    <h2 class="header pb-5 text-center">Add Account</h2>
                    @if(Session::has('message'))
                    <h4 class="header pb-1 pt-1 text-center" style="color: {{Session::get('color')}};">{{Session::get('message')}}</h4>
                    @endif
                <div class="form-group row">
                    <label for="number" class="col-lg-3 col-form-label form-control-label">Account Number</label>
                    <div class="col-lg-6">
                        <input class="form-control" type="number" value="{{@old('number')}}" name="number" id="number" >
                        @error('number')
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