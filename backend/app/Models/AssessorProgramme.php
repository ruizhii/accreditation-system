<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssessorProgramme extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessor_id',
        'programme_id',
        'is_completed'
    ];

    public function assessor(): BelongsTo
    {
        return $this->belongsTo(Assessor::class);
    }

    public function academicProgramme(): BelongsTo
    {
        return $this->belongsTo(AcademicProgramme::class, 'programme_id');
    }

    public function assessorProgrammeAreas(): HasMany
    {
        return $this->hasMany(AssessorProgrammeArea::class);
    }
}
