<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubAdminEditRequest extends FormRequest
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
            'name' => 'required',
//            'email' => 'required',
//            'password' => 'required',
            'hire_date' => 'required',
            'job_title' => 'required',
            'home_address' => 'required',
            'resume' => 'mimes:doc,pdf,docx,zip',
            'phone_no' => 'required',
            'description' => 'required',
            'privileges' => 'required|min:1',
        ];
    }

    public function messages()
    {
        return [
            'privileges.min' => 'Please Select at least one Privilege',
            'privileges.required' => 'Please Select at least one Privilege',
        ];
    }
}
