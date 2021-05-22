<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function field(){
        if(filter_var(request()->email,FILTER_VALIDATE_EMAIL)){
            return'email';
        }elseif(filter_var(request()->email,FILTER_VALIDATE_FLOAT)){
            return'mobile';
        }else{
            return 'username';
        }
    }

    public function login(){
        if(Auth::guard("web")->validate([$this->field()=>request('email'),'password'=>request('password')])){
             $user=User::where($this->field(),'=',request('email'))->first();
            if($user->balance > 0){
                Auth::guard("web")->attempt([$this->field()=>request('email'),'password'=>request('password')]);
                return redirect()->intended('/');
            }elseif($user->status==1){
                Auth::guard("web")->attempt([$this->field()=>request('email'),'password'=>request('password')]);
                return redirect()->intended('/');
            }else{
                return redirect()->back()->withErrors(['success'=>'You are blocked']);
            }
        } else{
            return redirect()->back()->with(['success'=>'The Username Or Password Does not Exists']);
        }
    }
}
