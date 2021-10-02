<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateRequest extends FormRequest
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
            'full_name' => 'required',
            'job_title' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:candidates',
            'city' => 'required',
            'state' => 'required',
            'salary' => 'required',
            'skills' => 'required',
            'interest' => 'required',
            'experience' => 'required',
            'education' => 'required',
            'Industry' => 'required',
//            'resume' => 'required',
//            'name' => 'unique:statuses',
//            'color' => 'unique:statuses',
//            'resume.*' => 'mimes:doc,pdf,docx,zip',

        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'Please enter a valid Email Address.',
        ];
    }
}
