<?php

namespace App\Filament\Resources\ProgrammeStandardResource\Pages;

use App\Filament\Resources\ProgrammeStandardResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProgrammeStandard extends EditRecord
{
    protected static string $resource = ProgrammeStandardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
