<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

       $transactions= Transaction::with('senders')->with('receivers')->get();
        return view('admin.transactions.index',compact('transactions'));
    }

    public function getTransactionsById($id){

        $transactions=Transaction::where('sender_id','=',$id)->orWhere('receiver_id','=',$id)->get();
        return view('admin.transactions.transactionsbyid',compact('transactions'));

    }
}
