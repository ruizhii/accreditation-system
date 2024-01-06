<?php

namespace App\Console;

use App\Mail\FacultyDueingAccreditationReminder;
use App\Models\Faculty;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class RemindFacultyDueingAccreditation 
{
    public function __invoke($x)
    {
        $emails = Faculty::whereHas('departments.academic_programmes.accreditations', function($q) {
            $q->where('expiry_date', '<', Carbon::now());
        })->map(function (Faculty $faculty) {
            $faculty->email;
        })->get();

        foreach ($emails as $email) {
            Mail::to($email)->send(new FacultyDueingAccreditationReminder());
        }
    }
}
    
?>
