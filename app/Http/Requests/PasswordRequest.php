<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            //
            'current_password' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required_with:password|same:password'
        ];
    }

    public function messages()
    {
        return [
            'password_confirmation.required_with:password|same:password|min:6' => 'The confirm password Field is required',
        ];
    }
}
