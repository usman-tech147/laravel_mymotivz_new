<?php

namespace App\Http\Requests;

use App\Rules\AlphaNumericSpace;
use App\Rules\AlphaSpace;
use App\Rules\CurrencyValidation;
use App\Rules\ValidUrl;
use Illuminate\Foundation\Http\FormRequest;

class JobDetailRequest extends FormRequest
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
//        dd('request');
        return [
//            'jobtitle' => 'required|regex:/^[a-zA-Z\s]*$/|min:2|max:255',
            'jobtitle' => ['required','min:2','max:255', new AlphaNumericSpace()],
            'education' => 'required',
            'location' => 'required',
            'web_url' => ['required', new ValidUrl()],
            'package' => ['required','min:1','max:20', new CurrencyValidation()],
            'package_to' => ['nullable','min:1','max:20', new CurrencyValidation()],
            'salary_duration' => 'required',
            'industry' => 'required',
            'service' => 'required',
            'job_discription' => 'required',
            'num_hires' => 'required',
            'job_benefits' => 'max:1000',
            'required_skills' => 'max:1000',
            'required_certification' => 'max:1000',
            'required_experience' => 'required',
            'applied_before' => 'required|date|after:today',


        ];
    }

    public function messages()
    {
        return [
            'jobtitle.required' => 'Job title is required',
            'jobtitle.regex' => 'Only characters are required',
            'jobtitle.min' => 'Job Title must be greater than 2 characters',
            'jobtitle.max' => 'Job Title must be less than 255 characters',
            'education.required' => 'Education is required',
            'location.required' => 'Job location is required',
            'location.regex' => 'Only characters are required for job location',
            'location.min' => 'Job location must be greater than 2 characters',
            'location.max' => 'Job location must be less than 255 characters',
            'web_url.required' => 'Web URL is required',
            'web_url.url' => 'URL must be valid',
            'package.required' => 'Salary is required',
            'package.regex' => 'Salary must be in valid format',
            'package.min' => 'Salary must be greater than 1 digits',
            'package.max' => 'Salary must be less than 20 digits',
            'package_to.regex' => 'Salary must be in valid format',
            'package_to.max' => 'Salary must be less than 20 digits',
            'industry.required' => 'Industry is required',
            'service.required' => 'Service is required',
            'job_discription.required' => 'Job Description is required',
//            'job_discription.max' => 'Job Description must be less than 1000 characters',
/*            'job_responsibilities.required' => 'Job Responsibilities is required',
            'job_responsibilities.min' => 'Job Responsibilities must be greater than 2 characters',
            'job_responsibilities.max' => 'Job Responsibilities must be less than 1000 characters',*/
            'job_benefits.required' => 'Job Benefits are required',
            'job_benefits.min' => 'Job Benefits must be greater than 2 characters',
            'job_benefits.max' => 'Job Benefits must be less than 1000 characters',
            'required_skills.required' => 'Skills are required',
            'required_skills.min' => 'Skills must be minimum 2 characters long',
            'required_skills.max' => 'Skills must be less than 1000 characters',
            'required_certification.required' => 'Licensure/Certification are required',
            'required_certification.min' => 'Licensure/Certification  must be minimum 2 characters long',
            'required_certification.max' => 'Licensure/Certification  must be less than 1000 characters',
            'required_experience.required' => 'Experience is required',
            'num_hires.required' => 'Number of Hires is required',
            'applied_before.required' => 'Applied Before date is required',
            'applied_before.date' => 'Applied before must be in Date format',
            'applied_before.after' => 'Applied before date must be after Today\'s Date',
        ];
    }
}
