<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'director_name',
        'director_email',
        'tel',
        'fax',
        'website',
        'department',
        'academic_staff',
        'no_student',
        'student_attrition',
        'administrative_staff',
        'annual_allocation',
        'organizational_chart',
        'programme_leader'
    ];

    protected $casts = [
        'no_student' => 'json',
        'annual_allocation' => 'json',
        'department' => 'json',
        'academic_staff' => 'json',
        'student_attrition' => 'json',
        'administrative_staff' => 'json',
        'programme_leader' => 'json',
    ];

    public function academic_programmes(): HasMany
    {
        return $this->hasMany(AcademicProgramme::class);
    }
}
