<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class companyRegistrationRequest extends FormRequest
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
            'email'=>'required|unique:new_candidates,email|unique:new_clients,email',
            'password'=> 'required|confirmed',
            'compnay_name' => "required"
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required',
            'email.unique' => 'Email already exists',
            'password.required'  => 'Password is required',
            'password.confirmed'  => 'Password did not match',
            'compnay_name.required'  => 'Company name is required',
        ];
    }
}
