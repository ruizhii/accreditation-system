<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccreditationResource extends JsonResource
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
            'title' => $this->title,
            'type' => $this->type,
            'phase_num' => $this->phase_num,
            'matter_expert_panel' => $this->matter_expert_panel,
            'insider_panel' => $this->insider_panel,
            'submission_panel_due_date' => $this->submission_panel_due_date,
            'panel_meeting_date' => $this->panel_meeting_date,
            'faculty_visit_date' => $this->faculty_visit_date,
            'closing_meeting_date' => $this->closing_meeting_date,
            'panel_report_qmec_date' => $this->panel_report_qmec_date,
            'report_mqa_date' => $this->report_mqa_date,
            'status' => $this->status,
            'academic_programme_id' => $this->academic_programme->id,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s') ?? '',
        ];
    }
}
