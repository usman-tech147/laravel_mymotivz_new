<?php

namespace App\Http\Requests;

use App\Rules\ValidUrl;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
//        $regex = '/^(https:\/\/www\.|http:\/\/www\.|www\.)[a-zA-Z0-9\-_$]+\.[a-zA-Z]{2,5}$/';
        return [
            'company_name' => 'required|unique:clients',
            'name' => 'required',
            'job_title' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:clients',
            'city' => 'required',
            'state' => 'required',
//            'web_url' => 'nullable|url',
            'web_url' => ['nullable', new ValidUrl()],
            'industry' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'phone.required' => 'The phone number field is required',
            'email.required' => 'Please enter email address',
        ];
    }
}
