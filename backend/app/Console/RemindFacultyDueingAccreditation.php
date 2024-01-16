<?php

namespace App\Console;

use App\Mail\FacultyDueingAccreditationReminder;
use App\Models\Faculty;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RemindFacultyDueingAccreditation 
{
    public function __invoke()
    {
        $faculties = Faculty::whereHas('departments.academic_programmes.accreditations', function($q) {
            $q->where('expiry_date', '<', Carbon::now());
        })->get();

        foreach ($faculties as $faculty) {
            $email = $faculty->director_email;

            if (!$email) {
                continue;
            }

            Log::info("Sending reminder email to {$email}");
            Mail::to($email)->send(new FacultyDueingAccreditationReminder($faculty));
        }
    }
}
    
?>
