<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {

        return view('website.customers.profile');
    }

    public function updateProfile(Request $request)
    {
        $validate=Validator::make($request->only('name','username','email','mobile','age','password'),$this->profileRules(),$this->profileMessages());
        if ($validate->fails()){
            return redirect()->route('customer.profile.index')->withErrors($validate->errors())->with(['message' => 'Your not updated please check errors', 'color'=>'red']);
        }

        if (Auth::guard('web')->validate(['id' => Auth::user()->id, 'password' => $request->password])) {
            $user = User::find(Auth::user()->id);
            $user->update([
                'name' => $request['name'],
                'username' => $request['username'],
                'email' => $request['email'],
                'mobile' => $request['mobile'],
            ]);
            return redirect()->route('customer.profile.index')->with(['message' => 'Your profile updated successfully', 'color'=>'green']);
        } else {
            return redirect()->route('customer.profile.index')->with(['message' => 'Your password incorrect please try again', 'color'=>'red']);
        }
    }

    public function updateImage(Request $request){


        $validate=Validator::make($request->only('image'),['image'=>['image','required']],['image'=>'Please choose image only','required'=>'Please choose image first']);
        if ($validate->fails()){
            return redirect()->route('customer.profile.index')->withErrors($validate->errors())->with(['message' => 'Your image not updated please check errors', 'color'=>'red']);
        }
        try {
            $user = User::find(Auth::user()->id);
            $oldimage = $user->image;
            {
                $imagename = $request->id . time() . $request->image->hashName();
            }
            $user->update([
                'image' => $imagename,
            ]);
            $request->image->move(base_path() . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'customers' . DIRECTORY_SEPARATOR, $imagename);
            try {
                if (!($oldimage == 'user.jpg'))
                    unlink(base_path() . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'customers' . DIRECTORY_SEPARATOR . $oldimage);
            } catch (\Exception $e) {
            }

            return redirect()->route('customer.profile.index')->with(['message' => 'Your image updated successfully', 'color' => 'green']);
        }catch (\Exception $e){
            return redirect()->route('customer.profile.index')->with(['message' => 'Your image not updated please try agaun', 'color' => 'red']);
        }
    }


    public function updatePassword(Request $request)
    {
        $passwordRegEx = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/';
        $validate = Validator::make($request->only('oldpassword','password','password_confirmation'), [
            'oldpassword' => ['required'],
            'password' => ['required', 'confirmed','min:8','regex:'.$passwordRegEx],
        ], [
            'required' => 'this field is required',
            'confirmed' => 'the password does not matched',
            'regex'=>'the password must contains at least upper word, lower word and numbers',
            'min' => 'the password must be more than 8 character',
        ]);
        if ($validate->fails()) {
            return redirect()->route('customer.profile.index')->withErrors($validate->errors())->with(['message' => 'Your password not changed please check errors', 'color'=>'red']);
        } else {
            if (Auth::guard('web')->validate(['username' => Auth::user()->username, 'password' => $request->oldpassword])) {

                $user = User::find(Auth::user()->id);
                $user->update([
                    'password' => Hash::make($request['password']),
                ]);
                return redirect()->route('customer.profile.index')->with(['message' => 'Your password updated successfully', 'color' => 'green']);
            } else {
                return redirect()->route('customer.profile.index')->with(['message' => 'Your password is  incorrect', 'color' => 'red']);
            }

        }
    }



    private function profileRules(){

        $nameRegEx = '/^[a-zA-Z0-9]*([a-zA-Z0-9](_|\.|\w| )[a-zA-Z0-9])*[a-zA-Z0-9]*/';
        $usernameRegEx = '/^[a-zA-Z0-9]*([a-zA-Z0-9](_|\.)[a-zA-Z0-9])*[a-zA-Z0-9]*/';
        $mobileRegEx = '/^[\+]?[0-9]*/';
        $emailRegEX = '/^[a-zA-Z0-1]+[@][a-zA-Z0-1]+[\.][a-zA-Z0-1]+/';
        $passwordRegEx = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/';
            return [
                'name' => ['required', 'regex:' . $nameRegEx, 'max:100'],//done
                'username' => ['required', 'unique:customers,username,'.Auth::user()->id, 'max:20', 'regex:' . $usernameRegEx],//done
                'mobile' => ['required', 'unique:customers,mobile,'.Auth::user()->id, 'min:3', 'max:14', 'regex:' . $mobileRegEx],//done
                'email' => ['required', 'unique:customers,email,'.Auth::user()->id, 'regex:' . $emailRegEX],//done
                'age'=>['numeric','min:20'],
            ];
    }

    private function profileMessages(){

        return [
            'required' => 'this field required',
            'numeric' => 'this field numbers only',
            'age.min' => 'Your age must be greater than 20',
            'username.unique'=>'username already used',
            'username.max'=>'username must be less than 20 character',
            'username.regex'=>'Only Can Use _ Or . But Can Not Start Or End With Them',
            'name.max'=>'The Username Must Be Less Than 32',
            'name.regex'=>'Only Can Use (\'_\',\'.\' Or \'Space\') But Can Not Start Or End With Them',
            'email.unique'=>'This Email Is Already Used',
            'email.regex'=>'Email Format Example:(example@example.c)',
            'mobile.unique'=>'This Mobile Is Already Used',
            'mobile.min'=>'The Mobile Must Be Greater Than 3',
            'mobile.max'=>'The Mobile Must Be Less Than 14 Number',
            'mobile.regex'=>'You Can Use Only Numbers And +',
            'password.confirmed'=>'The Password Does Not Matched',
            'password.min'=>'The Password Must Be Greater Than 8 character',
            'password.max'=>'The Password Must Be Less Than 30 character',
            'password.regex'=>'Must Contain At Least Upper Letter , Lower Letter And Number',

        ];
    }


}
