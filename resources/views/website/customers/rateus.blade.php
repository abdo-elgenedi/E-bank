@extends('layouts.website')
@section('content')
    <section class="site-section">
        <div class="container" style="min-height: 300px">
            <form role="form" method="POST" action="{{ route('customer.rate.send') }}">
                @csrf
                <div class="card p-5" style="width: 70%;margin: auto">
                    <h2 class="header pb-5 text-center">Rating</h2>

                    <div class="form-group row">
                        <label for="opinion" class="col-lg-3 col-form-label form-control-label">Opinion</label>
                        <div class="col-lg-6">
                            <textarea maxlength="255" style="height: 230px" class="form-control" name="opinion" id="opinion" required></textarea>
                            @error('opinion')
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