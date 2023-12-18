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
        'sub',
        'standard_coppa',
        'keys_element',
        'evidence',
        'coppa_requirement',
        'evidence_status',
        'notes',
        'information_request',
        'question',
        'observation',
    ];

    public function assessorProgrammeSection(): BelongsTo
    {
        return $this->belongsTo(AssessorProgrammeSection::class);
    }
}
