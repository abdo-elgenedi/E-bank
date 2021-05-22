<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $nameRegEx = '/^[a-zA-Z0-9]*([a-zA-Z0-9](_|\.|\w| )[a-zA-Z0-9])*[a-zA-Z0-9]*/';
        $usernameRegEx = '/^[a-zA-Z0-9]*([a-zA-Z0-9](_|\.)[a-zA-Z0-9])*[a-zA-Z0-9]*/';
        $mobileRegEx = '/^[\+]?[0-9]*$/';
        $emailRegEX = '/^[a-zA-Z0-1]+[@][a-zA-Z0-1]+[\.][a-zA-Z0-1]+/';
        $passwordRegEx = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/';
            return [
                'name' => ['required', 'regex:' . $nameRegEx, 'max:100'],//done
                'username' => ['required', 'unique:admins,username,'.Auth::user()->id, 'max:20', 'regex:' . $usernameRegEx],//done
                'mobile' => ['required', 'unique:admins,mobile,'.Auth::user()->id, 'min:3', 'max:14', 'regex:' . $mobileRegEx],//done
                'email' => ['required', 'unique:admins,email,'.Auth::user()->id, 'regex:' . $emailRegEX],//done
            ];
    }

    public function messages()
    {
            return [
                'required' => 'this field is required',
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

            ];

    }
}
