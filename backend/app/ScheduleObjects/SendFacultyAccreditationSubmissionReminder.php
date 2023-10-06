<?php

namespace App\ScheduleObjects;

use App\Models\Faculty;
use Carbon\Carbon;

class SendFacultyAccreditationSubmissionReminder
{
    public function __invoke()
    {
        $today = Carbon::now();
        $beforeDay = $today->subMonth(3);

        $faculties = Faculty::whereHas('academic_programmes.accreditations', function ($query) use ($beforeDay) {
            $query->where('expiry_date', '>=', $beforeDay->toDateString());
        })->get()->all();

        $emails = array_column($faculties, 'email');
        var_dump($emails);
    }
}

