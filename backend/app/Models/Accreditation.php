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
        'accredited_date',
        'mqr_recorded_accredited_date',
        'expiry_date',
        'jpt_approval_letter_reference_number',
        'remarks',
        'academic_programme_id',
    ];

    public function academic_programme(): BelongsTo
    {
        return $this->belongsTo(AcademicProgramme::class);
    }
}
