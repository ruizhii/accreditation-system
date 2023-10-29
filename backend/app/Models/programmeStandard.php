<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class programmeStandard extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'document_path',
        'academic_programme_id',
    ];

    protected $casts = [

    ];

    protected $nullable = [

    ];

    public function academic_programme(): BelongsTo
    {
        return $this->belongsTo(AcademicProgramme::class);
    }
}


