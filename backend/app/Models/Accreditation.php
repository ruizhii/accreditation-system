<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accreditation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'type',
        'phase_num',
        'accredited_date',
        'mqr_recorded_accredited_date',
        'expiry_date',
        'jpt_approval_letter_reference_number',
        'remarks',
        'matter_expert_panel',
        'insider_panel',
        'submission_panel_due_date',
        'panel_meeting_date',
        'faculty_visit_date',
        'closing_meeting_date',
        'panel_report_qmec_date',
        'report_mqa_date',
        'status',
        'academic_programme_id',
    ];

    protected $casts = [
        'matter_expert_panel' => 'array',
        'insider_panel' => 'array',
        
    ];

    protected $nullable = [
        'submission_panel_due_date',
        'panel_meeting_date',
        'faculty_visit_date',
        'closing_meeting_date',
        'panel_report_qmec_date',
        'report_mqa_date',
    ];

    public function academic_programme(): BelongsTo
    {
        return $this->belongsTo(AcademicProgramme::class);
    }
}
