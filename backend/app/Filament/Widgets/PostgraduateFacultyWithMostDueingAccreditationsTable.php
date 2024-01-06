<?php

namespace App\Filament\Widgets;

use App\Models\Faculty;
use Carbon\Carbon;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PostgraduateFacultyWithMostDueingAccreditationsTable extends BaseWidget
{
    protected static ?string $heading = 'Faculty with Most Dueing Accreditation (PG)';
    protected static ?int $sort = 4;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Faculty::whereHas('departments.academic_programmes.accreditations', function($q) {
                    $q->where('expiry_date', '<', Carbon::now());
                })
            )
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('count')
                ->getStateUsing(function(Faculty $record) {
                    return $record->get_expired_accreditation_count_postgraduate();
                }),
            ]);
    }
}
