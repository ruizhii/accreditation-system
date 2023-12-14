<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicProgramme extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'mqf_level',
        'mqr_no',
        'required_graduating_credit',
        'accredited_um',
        'award_type',
        'old_nec',
        'new_nec',
        'location_conducted',
        'instruction_language',
        'programme_type',
        'programme_status',
        'study_mode',
        'offer_mode',
        'teaching_method',
        'delivery_mode',
        'study_duration',
        'first_intake_date',
        'student_enrolment',
        'graduation_date',
        'graduate_job_type',
        'awarding_body',
        'scroll_awarded',
        'programme_coordinator',
        'department_id',
    ];

    protected $casts = [
        'accredited_um' => 'json',
        'teaching_method' => 'array',
        'delivery_mode' => 'array',
        'student_enrolment' => 'json',
        'graduate_job_type' => 'array',
        'awarding_body' => 'json',
        'scroll_awarded' => 'json',
        'programme_coordinator' => 'json',

    ];

    protected $nullable = [

    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function accreditations(): HasMany
    {
        return $this->hasMany(Accreditation::class);
    }

    public function programme_standards(): HasMany
    {
        return $this->hasMany(ProgrammeStandard::class);
    }

    public function assessorProgramme(): HasOne
    {
        return $this->hasOne(AssessorProgramme::class, 'programme_id');
    }
}
