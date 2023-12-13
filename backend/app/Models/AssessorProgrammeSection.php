<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssessorProgrammeSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessor_programme_area_id',
        'section',
    ];

    public function assessorProgrammeArea(): BelongsTo
    {
        return $this->belongsTo(AssessorProgrammeArea::class);
    }

    public function AssessorProgrammeSub(): HasMany
    {
        return $this->hasMany(AssessorProgrammeSub::class);
    }
}
