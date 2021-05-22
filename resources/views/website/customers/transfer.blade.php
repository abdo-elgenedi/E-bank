@extends('layouts.website')
@section('content')
<link rel="stylesheet" href="{{asset('assets/website/css/transfer.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
<div class="container-fluid mt-5" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>Sending money became easy</strong></h2>
                <p>Fill all form field to go to next step</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" action="{{route('customer.transfer.send')}}" method="post">
                            @csrf
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="account"><strong>Destination</strong></li>
                                <li id="personal"><strong>Receiver</strong></li>
                                <li id="payment"><strong>Amount</strong></li>
                                <li id="confirm"><strong>Finish</strong></li>
                            </ul> <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <p id="emailerror" class="text-center" style="color:red"></p>
                                    <h2 class="fs-title">Receiver Email</h2>
                                    <input type="email" name="email" id="email" placeholder="Receiver Email" />
                                    <label class="bg-info" style="color:white">If the receiver does not have account ask him to create one , it's easy now</label>
                                </div>
                                <input type="button" name="checkemail" class="action-button checkemail" value="Next Step" />
                                <input type="hidden" name="nextstep" id="next" class="nextstep action-button " value="Next Step" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Receiver Confirmation</h2>
                                    <label class="bg-danger" style="color:white"> be sure that the receiver data match the receiver that you want </label>
                                    <div class=""><img id="receiverCheckImage" src="" width="150" height="150" class="img-circle"></div>
                                    <div class="n In-md-8 mt-3">
                                             <div class="row">
                                                    <div class="col-md-4">
                                                        <label>name</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <p id="receiverCheckName"></p>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Email</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <p id="receiverCheckEmail"></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Mobile</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <p id="receiverCheckMobile"></p>
                                                    </div>
                                                </div>
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previousstep action-button-previous" value="Previous" />
                                <input type="button" name="nextstep" class="nextstep action-button" value="Next Step" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Amount</h2>
                                    <div class="form-card">
                                        <p id="amounterror" class="text-center" style="color:red"></p>
                                        <h2 class="fs-title">Amount</h2>
                                        <input type="number" id="amount" name="amount" placeholder="Enter the amount" />
                                        <label>Please Note Your Balance is : {{Auth::user()->balance}} $</label>
                                        <hr>
                                        <h2 class="fs-title">Confirm your password</h2>
                                        <input type="password" name="password" placeholder="Enter your password" />
                                        <hr>
                                        <h2 class="fs-title">Comment</h2>
                                        <input type="text" name="details" placeholder="Leave comment to the receiver if you want" />
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previousstep action-button-previous" value="Previous" />
                                <input type="button" name="make_payment" id="done" class="action-button" value="Confirm" />
                            </fieldset>


                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title text-center">Success !</h2> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-3"> <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image"> </div>
                                    </div> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-9 text-center">
                                            <h5>The Transaction Done Successfully</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-card" style="display:none; ">
                                    <h2 class="fs-title text-center">Failed !</h2> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-3"> <img src="https://img.icons8.com/office/80/000000/delete-sign.png" class="fit-image"> </div>
                                    </div> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-9 text-center">
                                            <h5>The Transaction Failed Try Again Later</h5>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        window.onload=function (){


            $(document).on('click','.checkemail',function (e) {
                e.preventDefault();
                {
                    $.ajax({
                        type: 'post',
                        url: '{{route('customer.transfer.checkemail')}}',
                        data: {
                            'email': $("#email").val(),
                            '_token':'{{csrf_token()}}'
                        },
                        success: function (data) {
                            if (data.emailstatus === 'error') {
                                $("#emailerror").text(data.message)
                            }else if(data.emailstatus==='success'){
                                $("#emailerror").text('');
                                $('#receiverCheckImage').attr('src', '{{asset('images/customers')}}'+'/'+data.image);
                                $("#receiverCheckName").text(data.name);
                                $("#receiverCheckEmail").text(data.email);
                                $("#receiverCheckMobile").text(data.mobile);
                                $("#next").click();
                            }
                        },
                        error: function (reject) {

                        }
                    })
                }
            });




            $(document).on('click','#done',function (e) {
                e.preventDefault();
                 {
                    $.ajax({
                        type: 'post',
                        url: '{{route('customer.transfer.checkamount')}}',
                        data: {
                            'amount': $("#amount").val(),
                            '_token':'{{csrf_token()}}'
                        },
                        success: function (data) {
                            if (data.amountstatus === 'error') {
                                $("#amounterror").text(data.message)
                            }else if(data.amountstatus==='success'){
                                $("#amounterror").text('');
                               $("#msform").submit();
                            }
                        },
                        error: function (reject) {

                        }
                    })
                }
            });




            $(document).ready(function(){

                var current_fs, next_fs, previous_fs; //fieldsets
                var opacity;

                $(".nextstep").click(function(){

                    current_fs = $(this).parent();
                    next_fs = $(this).parent().next();

                    //Add Class Active
                    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                    //show the next fieldset
                    next_fs.show();
                    //hide the current fieldset with style
                    current_fs.animate({opacity: 0}, {
                        step: function(now) {
                            // for making fielset appear animation
                            opacity = 1 - now;

                            current_fs.css({
                                'display': 'none',
                                'position': 'relative'
                            });
                            next_fs.css({'opacity': opacity});
                        },
                        duration: 600
                    });
                });

                $(".previousstep").click(function(){

                    current_fs = $(this).parent();
                    previous_fs = $(this).parent().prev();

//Remove class active
                    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
                    previous_fs.show();

//hide the current fieldset with style
                    current_fs.animate({opacity: 0}, {
                        step: function(now) {
// for making fielset appear animation
                            opacity = 1 - now;

                            current_fs.css({
                                'display': 'none',
                                'position': 'relative'
                            });
                            previous_fs.css({'opacity': opacity});
                        },
                        duration: 600
                    });
                });

                $('.radio-group .radio').click(function(){
                    $(this).parent().find('.radio').removeClass('selected');
                    $(this).addClass('selected');
                });

                $(".submit").click(function(){
                    return false;
                })

            });
        }
    </script>
@endsection