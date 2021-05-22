<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(){
         return view('website.customers.rateus');
    }

    public function send(Request $request){

        $validation=Validator::make($request->only('opinion'),['opinion'=>['required','string','max:255']],['required'=>'this field is required','string'=>'must be string only','max'=>'max 255 words']);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        Testimonial::create([
            'customer_id'=>Auth::user()->id,
            'opinion'=>$request->opinion,
            'status'=>0,
        ]);

        return redirect('/')->with(['message'=>'Your opinion sent successfully , We want to thank you too','color'=>'green']);
    }
}
