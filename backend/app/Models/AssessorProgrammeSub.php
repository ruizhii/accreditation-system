<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssessorProgrammeSub extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessor_programme_section_id',
        'title',
        'standard_coppa',
        'keys_element',
        'evidence',
        'coppa_requirement',
        'evidence_status',
        'notes',
        'information_request',
        'question',
        'observation',
        'suggested_score',
        'panel_score',
        'commendations',
        'affirmations',
        'recommendations',
    ];

    public function assessorProgrammeSections(): BelongsTo
    {
        return $this->belongsTo(AssessorProgrammeSection::class);
    }
}
