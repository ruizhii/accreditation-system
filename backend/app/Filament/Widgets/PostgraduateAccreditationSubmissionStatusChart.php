<?php

namespace App\Filament\Widgets;

use App\Models\Accreditation;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class PostgraduateAccreditationSubmissionStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Postgraduate Accreditation Submission Status';

    protected function getData(): array
    {
        $duedCount = Accreditation::where('expiry_date', '<', Carbon::now())
                                    ->whereHas('academic_programme', function($q) {
                                        $q->where('graduate_level', 'postgraduate');
                                    })->count();
        return [
            'datasets' => [
            [
                'label' => 'Status',
                'data' => [ $duedCount, 30, 10, 20 ],
                'backgroundColor' => '#36A2EB',
                'borderColor' => '#9BD0F5',
            ],
        ],
        'labels' => [ 'dued', 'ongoing', 'reviewing', 'completed' ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
