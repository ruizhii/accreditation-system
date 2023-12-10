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
        'type',
        'phase_num',
        'accredited_date',
        'mqr_recorded_accredited_date',
        'expiry_date',
        'jpt_approval_letter_reference_number',
        'remarks',
        'submission_panel_due_date',
        'panel_meeting_date',
        'faculty_visit_date',
        'closing_meeting_date',
        'panel_report_qmec_date',
        'report_mqa_date',
        'status',
        'academic_programme_id',
    ];

    public function academic_programme(): BelongsTo
    {
        return $this->belongsTo(AcademicProgramme::class);
    }
}
