<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BankRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'id'=>['required','max:9999','min:1000','numeric','unique:banks,id,'.$request->id],
            'name' => ['required','string'],//done0
            'mobile' => ['unique:banks,mobile,'.$request->id,'numeric'],//done
            'email' => ['required','unique:banks,email,'.$request->id,'email'],//done
            'image' => ['image'],//done
        ];
    }

    public function messages()
    {
        return [
            'id.required'=>'The id field is required',
            'id.min'=>'The id must be 4 digits and not start with 0',
            'id.max'=>'The id must be 4 digits and not start with 0',
            'id.unique'=>'This id belongs to another bank',
            'name.required'=>'The name field is required',
            'name.string'=>'The name field must be string',
            'website.url'=>'This is not a link ',
            'mobile.required'=>'The mobile field is required',
            'mobile.unique'=>'This mobile belongs to another bank',
            'mobile.numeric'=>'The mobile can contains numbers only',
            'email.required'=>'The email field is required',
            'email.unique'=>'This email belongs to another bank',
            'email.email'=>'The email must be like "example@example.c"',
            'image.required'=>'please choose bank image',



        ];
    }
}
