<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(){

        $transactions=Transaction::where('sender_id','=',Auth::user()->id)->orWhere('receiver_id','=',Auth::user()->id)->with('senders')->with('receivers')->get();
        return view('website.customers.transactions',compact(['transactions']));
    }
}
