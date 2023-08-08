<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicProgramme extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'graduate_level',
        'study_mode',
        'nec_2010',
        'nec_2020',
        'min_semester',
        'max_semester',
        'required_graduation_credit',
        'degree_qualification_type',
        'faculty_id',
    ];

    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }

    public function accreditations(): HasMany
    {
        return $this->hasMany(Accreditation::class);
    }
}
