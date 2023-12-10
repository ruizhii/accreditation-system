<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssessorProgrammeArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'area',
        'progress_percentage',
        'assessor_programme_id',
    ];

    public function assessorProgramme(): BelongsTo
    {
        return $this->belongsTo(AssessorProgramme::class);
    }

    public function assessorProgrammeSections(): HasMany
    {
        return $this->hasMany(AssessorProgrammeSection::class);
    }
}
