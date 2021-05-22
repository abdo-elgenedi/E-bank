<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function getRegister(){
        return view('auth.register');
    }
    protected function validator(array $data)
    {
        $nameRegEx = '/^[a-zA-Z0-9]*([a-zA-Z0-9](_|\.|\w| )[a-zA-Z0-9])*[a-zA-Z0-9]*$/';
        $usernameRegEx = '/^[a-zA-Z0-9]*([a-zA-Z0-9](_|\.)[a-zA-Z0-9])*[a-zA-Z0-9]*$/';
        $mobileRegEx = '/^[\+]?[0-9]*$/';
        $emailRegEX = '/^[a-zA-Z0-9]+[@][a-zA-Z0-9]+[\.][a-zA-Z0-9]+/';
        $passwordRegEx = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/';
        return Validator::make($data, [
            'name' => ['required', 'regex:' . $nameRegEx, 'max:100'],//done
            'password' => ['required', 'min:8', 'confirmed', 'regex:' . $passwordRegEx],//done
            'username' => ['required', 'unique:customers,username', 'max:20', 'regex:' . $usernameRegEx],//done
            'mobile' => ['required', 'unique:customers,mobile', 'min:3', 'max:14', 'regex:' . $mobileRegEx],//done
            'email' => ['required', 'unique:customers,email', 'regex:' . $emailRegEX],//done
            'age'=>['numeric','min:20'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'age' => $data['age'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
