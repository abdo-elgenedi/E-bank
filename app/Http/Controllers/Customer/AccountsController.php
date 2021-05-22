<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Bank;
use App\Models\CustomerAccount;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AccountsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(){

        $accounts=CustomerAccount::where('customer_id','=',Auth::user()->id)->with('bank')->get();
        return view('website.customers.accounts.index',compact(['accounts']));
    }

    public function add(){

        return view('website.customers.accounts.add');
    }
    public function addAccount(Request $request){
        $validator=Validator::make($request->only('number','password'),[
            'number'=>['numeric','min:100000000000000','max:999999999999999','required'],
            'password'=>['required']
            ],[
                'numeric'=>'this field must be a numbers only','max'=>'the account number must be 15 number','min'=>'the account number must be 15 number','required'=>'this field is required'
        ]);
        if ($validator->fails()){return redirect()->back()->withErrors($validator->errors())->withInput();}

        $account=Account::find($request->number);
        if (!$account){return redirect()->back()->with(['color'=>'red','message'=>'this account not founded']);}
        $bank=Bank::where('status','=','1')->find($account->bank_id);
        if (!$bank){return redirect()->back()->with(['color'=>'red','message'=>'We do not deal with this bank']);}
        $exists=CustomerAccount::where('account_id','=',$request->number)->where('customer_id','=',Auth::user()->id)->first();
        if ($exists){return redirect()->back()->with(['color'=>'red','message'=>'you are already link this account']);}
        $anotherExists=CustomerAccount::where('account_id','=',$request->number)->first();
        if ($anotherExists){return redirect()->back()->with(['color'=>'red','message'=>'This account linked to another user']);}
        if($account->password!=$request->password){return redirect()->back()->with(['color'=>'red','message'=>'the password is incorrect']);}
        try{
            CustomerAccount::create([
                'customer_id'=>Auth::user()->id,
                'account_id'=>$request->number,
                'bank_id'=>$account->bank_id,
            ]);
            return redirect()->route('customer.accounts.index')->with(['color'=>'green','message'=>'Your account linked successfully']);
        }catch (\Exception $e){
            return redirect()->route('customer.accounts.index')->with(['color'=>'red','message'=>'Your account not linked please try again']);
        }


    }

    public function delete($id){

        $account=CustomerAccount::where('account_id','=',$id);
        if (!$account){
            return redirect()->route('customer.accounts.index')->with(['color'=>'red','message'=>'we did not find this account']);
        }
        try {
            $account->delete();
            return redirect()->route('customer.accounts.index')->with(['color'=>'green','message'=>'Your account Unlinked successfully']);
        }catch (\Exception $e){
            return redirect()->route('customer.accounts.index')->with(['color'=>'red','message'=>'something went wrong Please try again']);
        }
    }

    public function deposit(){

        $accounts=CustomerAccount::where('customer_id','=',Auth::user()->id)->with('bank')->get();
        if (!$accounts){
            return redirect()->route('customer.accounts.index')->with(['color'=>'red','message'=>'Please link your bank account to make deposit']);
        }
        return view('website.customers.accounts.deposit',compact(['accounts']));
    }

    public function depositBalance(Request $request){

       $account=CustomerAccount::where('customer_id','=',Auth::user()->id)->where('account_id','=',$request->account)->first();
       if (!$account){
          return  redirect()->route('customer.accounts.index')->with(['color'=>'red','message'=>'The account not fount in your linked accounts']);
       }
        $oldbalance=User::select('balance')->where('email','=',Auth::user()->email)->first()->balance;
        if($oldbalance<$request->amount){
            return redirect()->route('customer.accounts.index')->with(['color'=>'red','message'=>'Your balance is lower than you want']);
        }
        if (!(Auth::guard('web')->validate(['email'=>Auth::user()->email,'password'=>$request->password])))
        {
            return redirect()->route('customer.accounts.index')->with(['color'=>'red','message'=>'Your password is incorrect']);
        }
        $bankAccount=Account::where('id','=',$request->account)->first();
        $bankBalance=$bankAccount->balance;
        try {
            DB::beginTransaction();
            $bankAccount->update([
                'balance' => ($bankBalance + $request->amount)
            ]);
            $user = User::where('email', '=', Auth::user()->email)->first();
            $user->update(['balance' => ($oldbalance - $request->amount)]);
            DB::commit();
            return redirect()->route('customer.accounts.index')->with(['color' => 'green', 'message' => 'Your deposit done successfully']);
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('customer.accounts.index')->with(['color' => 'red', 'message' => 'Your deposit not done please try again']);
        }
    }

    public function withdrawal(){
        $accounts=CustomerAccount::where('customer_id','=',Auth::user()->id)->with('bank')->get();
        if (!$accounts){
            return redirect()->route('customer.accounts.index')->with(['color'=>'red','message'=>'Please link your bank account to make deposit']);
        }
        return view('website.customers.accounts.withdrawal',compact(['accounts']));
    }


    public function withdrawalBalance(Request $request){

        $account=CustomerAccount::where('customer_id','=',Auth::user()->id)->where('account_id','=',$request->account)->first();
        if (!$account){
            return  redirect()->route('customer.accounts.index')->with(['color'=>'red','message'=>'The account not fount in your linked accounts']);
        }
        $oldbalance=Account::select('balance')->where('id','=',$request->account)->first()->balance;
        if($oldbalance<$request->amount){
            return redirect()->route('customer.accounts.index')->with(['color'=>'red','message'=>'Your balance is lower than you want']);
        }
        if (!(Auth::guard('web')->validate(['email'=>Auth::user()->email,'password'=>$request->password])))
        {
            return redirect()->route('customer.accounts.index')->with(['color'=>'red','message'=>'Your password is incorrect']);
        }
        $bankAccount=Account::where('id','=',$request->account)->first();
        $bankBalance=$bankAccount->balance;
        try {
            DB::beginTransaction();
            $bankAccount->update([
                'balance' => ($bankBalance - $request->amount)
            ]);
            $user = User::where('email', '=', Auth::user()->email)->first();
            $user->update(['balance' => ($user->balance + $request->amount)]);
            DB::commit();
            return redirect()->route('customer.accounts.index')->with(['color' => 'green', 'message' => 'Your deposit done successfully']);
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('customer.accounts.index')->with(['color' => 'red', 'message' => 'Your deposit not done please try again']);
        }
    }
}
