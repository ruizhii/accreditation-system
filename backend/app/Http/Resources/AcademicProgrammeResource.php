<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AcademicProgrammeResource extends JsonResource
{
    public static $wrap = false;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'mqf_level' => $this->mqf_level,
            'mqr_no' => $this->mqr_no,
            'required_graduating_credit' => $this->required_graduating_credit,
            'accredited_um' => $this->accredited_um,
            'award_type' => $this->award_type,
            'old_nec' => $this->old_nec,
            'new_nec' => $this->new_nec,
            'location_conducted' => $this->location_conducted,
            'instruction_language' => $this->instruction_language,
            'programme_type' => $this->programme_type,
            'programme_status' => $this->programme_status,
            'study_mode' => $this->study_mode,
            'offer_mode' => $this->offer_mode,
            'teaching_method' => $this->teaching_method,
            'delivery_mode' => $this->delivery_mode,
            'study_duration' => $this->study_duration,
            'first_intake_date' => $this->first_intake_date,
            'student_enrolment' => $this->student_enrolment,
            'graduation_date' => $this->graduation_date,
            'graduate_job_type' => $this->graduate_job_type,
            'awarding_body' => $this->awarding_body,
            'scroll_awarded' => $this->scroll_awarded,
            'programme_coordinator' => $this->programme_coordinator,
            'department_id' => $this->department->id,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s') ?? '',
        ];
    }
}
