<?php

namespace App\Filament\Resources\ProgrammeStandardResource\Pages;

use App\Filament\Resources\ProgrammeStandardResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgrammeStandards extends ListRecords
{
    protected static string $resource = ProgrammeStandardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
