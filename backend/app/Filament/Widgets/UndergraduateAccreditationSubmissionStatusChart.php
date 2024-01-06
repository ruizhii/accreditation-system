<?php

namespace App\Filament\Widgets;

use App\Models\Accreditation;
use App\Models\AssessorProgramme;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class UndergraduateAccreditationSubmissionStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Undergraduate Accreditation Submission Status';
    protected static ?int $sort = 1;

    protected function getData(): array
    {
        $duedCount = Accreditation::where('expiry_date', '<', Carbon::now())
                                    ->whereHas('academic_programme', function($q) {
                                        $q->where('graduate_level', 'undergraduate');
                                    })->count();
                
        $ongoingCount = Accreditation::where('status', 'Pending')
                                       ->whereHas('academic_programme', function($q) {
                                           $q->where('graduate_level', 'undergraduate');
                                       })->count();

        $reviewingCount = AssessorProgramme::where('is_completed', false)
                                             ->whereHas('academicProgramme', function($q) {
                                                $q->where('graduate_level', 'undergraduate');
                                             })->count();

        $completedCount = AssessorProgramme::where('is_completed', true)
                                             ->whereHas('academicProgramme', function($q) {
                                                $q->where('graduate_level', 'undergraduate');
                                             })->count();

        return [
            'datasets' => [
            [
                'label' => 'Status',
                'data' => [ $duedCount, $ongoingCount, $reviewingCount, $completedCount ],
                'backgroundColor' => '#36A2EB',
                'borderColor' => '#9BD0F5',
            ],
            ],
            'labels' => ['dued', 'ongoing', 'reviewing', 'completed'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
