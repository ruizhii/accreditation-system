<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFacultyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|max:55',
            'director_name' => 'string|max:55',
            'director_email' => 'email|string|max:55',
            'tel' => 'string|max:16',
            'fax' => 'string|max:55',
            'website' => 'string|max:55',
            'department' => 'array|nullable',
            'academic_staff' => 'array|nullable',
            'no_student' => 'array|nullable',
            'student_attrition' => 'array|nullable',
            'administrative_staff' => 'array|nullable',
            'annual_allocation' => 'array|nullable',
            'organizational_chart' => '',
            'programme_leader' => ''
        ];
    }
}
