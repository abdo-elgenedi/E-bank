<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(){

        return view('website.customers.transfer');
    }

    public function checkEmail(Request $request){
        if ($request->email==Auth::user()->email)
        {
            return response()->json([
               'emailstatus'=>'error',
               'message'=>'you can\'t transfer to yourself'
            ]);
        }
        $exists=User::where('email','=',$request->email)->first();
        if (!$exists){
            return response()->json([
                'emailstatus'=>'error',
                'message'=>'No user with this email ask him to create one'
            ]);
        }else{
            return response()->json([
                'emailstatus'=>'success',
                'image'=>$exists->image,
                'name'=>$exists->name,
                'email'=>$exists->email,
                'mobile'=>$exists->mobile,
            ]);
        }
    }
    public function checkAmount(Request $request){
        if ($request->amount<0||!isset($request['amount']))
        {
            return response()->json([
                'amountstatus'=>'error',
                'message'=>'Invalid amount format'
            ]);
        }
        elseif (($request->amount) > (Auth::user()->balance))
        {
            return response()->json([
               'amountstatus'=>'error',
               'message'=>'Your balance lower than you want'
            ]);
        }
       else{
            return response()->json([
                'amountstatus'=>'success',
            ]);
        }
    }

    public function send(Request $request){
        $exists=User::where('email','=',$request->email)->first();
        $checkPassword=Auth::guard('web')->validate(['email'=>Auth::user()->email,'password'=>$request->password]);
        if(!$exists || $exists->email==Auth::user()->email){
            return redirect()->route('customer.transactions.index')->with(['color'=>'red','message'=>'Your transaction failed please try again']);
        }
       elseif($request->amount<=0 || !isset($request['amount']) ||$request->amount>Auth::user()->balance ||$request->amount==null||$request->password==null || $checkPassword==false){
            try {
                Transaction::create([
                    'sender_id' => Auth::user()->id,
                    'receiver_id' => $exists->id,
                    'amount' => $request->amount,
                    'status' => '0',
                    'details' => $request->details,
                ]);
            }catch (\Exception $e){}
            return redirect()->route('customer.transactions.index')->with(['color'=>'red','message'=>'Your transaction failed please try again']);
        }

        else{
            $sender=User::find(Auth::user()->id);
            $receiver=$exists;
            try {
                DB::beginTransaction();
                $sender->update(['balance' => $sender->balance - $request->amount]);
                $receiver->update(['balance'=>$receiver->balance + $request->amount]);
                Transaction::create([
                    'sender_id' => $sender->id,
                    'receiver_id' => $receiver->id,
                    'amount' => $request->amount,
                    'status' => '1',
                    'details' => $request->details,
                ]);
                DB::commit();
                return redirect()->route('customer.transactions.index')->with(['color'=>'green','message'=>'Your transaction done successfully']);
            }catch (\Exception $e){
                DB::rollBack();
                return redirect()->route('customer.transactions.index')->with(['color'=>'red','message'=>'Your transaction failed please try again']);
            }
        }
    }

}
