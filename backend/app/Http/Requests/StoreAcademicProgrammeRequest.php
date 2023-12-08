<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAcademicProgrammeRequest extends FormRequest
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
            'mqf_level' => '',
            'mqr_no' => '',
            'required_graduating_credit' => '',
            'accredited_um' => 'array|nullable',
            'award_type' => '',
            'old_nec' => '',
            'new_nec' => '',
            'location_conducted' => '',
            'instruction_language' => '',
            'programme_type' => '',
            'programme_status' => '',
            'study_mode' => '',
            'offer_mode' => '',
            'teaching_method' => 'array|nullable',
            'delivery_mode' => 'array|nullable',
            'study_duration' => '',
            'first_intake_date' => '',
            'student_enrolment' => 'array|nullable',
            'graduation_date' => '',
            'graduate_job_type' => 'array|nullable',
            'awarding_body' => 'array|nullable',
            'scroll_awarded' => 'array|nullable',
            'programme_coordinator' => '',
            'department_id' => '',
        ];
    }
}
