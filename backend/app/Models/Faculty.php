<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

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

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }

    public function get_expired_accreditation_count_undergraduate()
    {
        return $this->departments()->whereHas('academic_programmes.accreditations', function($q) {
            $q->where('graduate_level', 'undergraduate')->where('expiry_date', '<', Carbon::now());
        })->count();
    }

    public function get_expired_accreditation_count_postgraduate()
    {
        return $this->departments()->whereHas('academic_programmes.accreditations', function($q) {
            $q->where('graduate_level', 'postgraduate')->where('expiry_date', '<', Carbon::now());
        })->count();
    }
}
