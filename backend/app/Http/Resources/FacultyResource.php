<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FacultyResource extends JsonResource
{
    public static $wrap = false;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'director_name' => $this->director_name,
            'director_email' => $this->director_email,
            'tel' => $this->tel,
            'fax' => $this->fax,
            'website' => $this->website,
            'department' => $this->department,
            'academic_staff' => $this->academic_staff,
            'no_student' => $this->no_student,
            'student_attrition' => $this->student_attrition,
            'administrative_staff' => $this->administrative_staff,
            'annual_allocation' => $this->annual_allocation,
            'organizational_chart' => $this->organizational_chart,
            'programme_leader' => $this->programme_leader,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s') ?? '',
        ];
    }
}
