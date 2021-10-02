<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoCreateRequest extends FormRequest
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
            'action' => 'required',
            'date' => 'required',
            'time' => 'required',
            'task' => 'required',

        ];
    }

//    public function messages()
//    {
//        return [
//            'phone.required' => 'The phone number field is required',
//            'email.required' => 'Please enter email address',
//        ];
//    }
}
