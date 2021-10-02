<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCandidateRequest extends FormRequest
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
            'name' => 'required',
            'job_title' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'city' => 'required',
            'state' => 'required',
            'salary' => 'required',
            'skills' => 'required',
            'interest' => 'required',
            'experience' => 'required',
            'education' => 'required',
            'Industry' => 'required',
//            'resume' => 'required',
//            'resume.*' => 'mimes:doc,pdf,docx,zip',
        ];
    }
}
