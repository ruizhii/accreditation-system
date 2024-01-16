<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccreditationRequest extends FormRequest
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
            'matter_expert_panel' => '',
            'insider_panel' => '',
            'submission_panel_due_date' => 'nullable',
            'panel_meeting_date' => 'nullable',
            'faculty_visit_date' => 'nullable',
            'closing_meeting_date' => 'nullable',
            'panel_report_qmec_date' => 'nullable',
            'report_mqa_date' => 'nullable',
            'instruction_language' => '',
            'status' => 'nullable',
            'academic_programme_id' => '',
        ];
    }
}
