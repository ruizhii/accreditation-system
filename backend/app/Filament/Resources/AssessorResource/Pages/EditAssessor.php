<?php

namespace App\Filament\Resources\AssessorResource\Pages;

use Filament\Actions;
use App\Models\Assessor;
use App\Traits\AssessorProgrammeTrait;
use App\Models\AssessorProgramme;
use Illuminate\Support\Facades\DB;
use App\Models\AssessorProgrammeArea;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\AssessorResource;

class EditAssessor extends EditRecord
{
    use AssessorProgrammeTrait;

    protected static string $resource = AssessorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
            // Actions\ForceDeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $assessorProgrammes = AssessorProgramme::where('assessor_id', $data['id'])->get();

        $options = $assessorProgrammes->mapWithKeys(function ($assessorProgramme) {
            return [$assessorProgramme->academicProgramme->id => $assessorProgramme->academicProgramme->name];
        })->values()->toArray();

        $data['academic_programmes'] = $options;

         return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $assessor = Assessor::find($data['id']);

        $assessorProgrammeIds = $assessor->assessorProgrammes->pluck('id')->toArray();
        $assessorProgrameToCreate = array_diff($data['academic_programmes'], $assessorProgrammeIds);
        $assessorProgrameToDelete = array_diff($assessorProgrammeIds, $data['academic_programmes']);

        if ($assessorProgrameToCreate) {
            foreach ($assessorProgrameToCreate as $academicProgrammeId) {
                $this->createAssessorPrograme($assessor, $academicProgrammeId);
            }
        }

        if ($assessorProgrameToDelete) {
            foreach ($assessorProgrameToDelete as $assessorProgrammeId) {
                $this->deleteAssessorPrograme($assessor, $assessorProgrammeId);
            }
        }

        return $data;
    }

    protected function createAssessorPrograme($assessor, $academicProgrammeId)
    {
        DB::beginTransaction();

        try {
            $assessorProgramme = $assessor->assessorProgrammes()->create([
                'assessor_id' => $assessor->id,
                'programme_id' => $academicProgrammeId,
            ]);

            $this->createAssessorProgrammeArea($assessorProgramme);

            DB::commit();
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
        }
    }

    protected function deleteAssessorPrograme($assessor, $assessorProgrammeId)
    {
        DB::beginTransaction();

        try {
            $assessorProgramme = $assessor->assessorProgrammes()->where('id', $assessorProgrammeId)->first();

            foreach ($assessorProgramme->assessorProgrammeAreas as $assessorProgrammeArea) {
                foreach ($assessorProgrammeArea->assessorProgrammeSections as $assessorProgrammeSection) {
                    $assessorProgrammeSection->assessorProgrammeSubs()->delete();
                }

                $assessorProgrammeArea->assessorProgrammeSections()->delete();
            }

            $assessorProgramme->assessorProgrammeAreas()->delete();
            $assessorProgramme->delete();

            DB::commit();
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
        }
    }
}
