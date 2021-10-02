<?php

namespace App\Http\Requests;

use App\Rules\ValidUrl;
use Illuminate\Foundation\Http\FormRequest;

class EditClientRequest extends FormRequest
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
            'company_name' => 'required',
            'name' => 'required',
            'job_title' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'city' => 'required',
            'state' => 'required',
            'web_url' => ['nullable', new ValidUrl()],
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => 'The phone number field is required',
        ];
    }
}
