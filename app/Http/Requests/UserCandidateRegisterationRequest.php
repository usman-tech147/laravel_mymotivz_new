<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCandidateRegisterationRequest extends FormRequest
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
        return [
            'email'=>'required|email|unique:new_clients,email',
            'password'=>'required|min:6|max:20|regex:/^(?=.*[0-9])(?=.*[A-Z])(?=.*\d).+$/',
            'password_confirmation' => 'required|same:password',

        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required',
            'email.email'    => 'Email should be valid',
            'email.unique' => 'Email already exists',
            'password.required'    => 'Password is Required',
            'password.min'   => 'Password should be minimum 6 characters long',
            'password.max'   => 'Password should be maximum 20 characters long',
            'password.regex' => 'Password must contain at least 1 number 1 uppercase and 1 Special Character',
            'password_confirmation.required' => 'Confirm Password is Required',
            'password_confirmation.same' => 'Confirm Password must be same as Password',
        ];
    }
}
