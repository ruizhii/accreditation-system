<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccreditationRequest extends FormRequest
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
            'title' => 'string|max:55',
            'type' => '',
            'phase_num' => '',
            'submission_panel_due_date' => '',
            'panel_meeting_date' => 'array|nullable',
            'faculty_visit_date' => '',
            'closing_meeting_date' => '',
            'panel_report_qmec_date' => '',
            'report_mqa_date' => '',
            'instruction_language' => '',
            'academic_programme_id' => '',
        ];
    }
}
