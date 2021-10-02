<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'company_name' => 'required',
            'jobtitle' => 'required',
            'city' => 'required',
            'state' => 'required',
            'package' => 'required',
           
            'web_url' => 'nullable|url',
        ];
    }
    public function messages()
    {
        return [
            'jobtitle.required' => 'The job title is required.',
        ];
    }
}
