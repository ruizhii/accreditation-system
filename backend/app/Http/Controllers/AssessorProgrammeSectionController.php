<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AssessorProgrammeSub;
use App\Models\AssessorProgrammeSection;

class AssessorProgrammeSectionController extends Controller
{
    public function show($programme_id, $id)
    {
        $assessorProgrammeSection = AssessorProgrammeSection::find($id);

        return view('assessors.programmes.section-show', compact('assessorProgrammeSection', 'programme_id', 'id'));
    }

    public function store($programme_id, $id, Request $request)
    {
        DB::beginTransaction();

        try {
            $updateSubs = [
                'coppa_requirements' => 'coppa_requirement',
                'evidence_statuses' => 'evidence_status',
                'notes' => 'notes',
                'information-requests' => 'information_request',
                'questions' => 'question',
                'observations' => 'observation',
            ];

            foreach ($updateSubs as $requestKey => $column) {
                if (isset($request[$requestKey])) {
                    foreach ($request[$requestKey] as $key => $value) {
                        $assessorProgrammeSub = AssessorProgrammeSub::find($key);

                        $assessorProgrammeSub->update([
                            $column => $value,
                        ]);
                    }
                }
            }

            $updateSections = [
                'commendations' => 'commendations',
                'affirmations' => 'affirmations',
                'recommendations' => 'recommendations',
            ];

            foreach ($updateSections as $requestKey => $column) {
                if (isset($request[$requestKey])) {
                    foreach ($request[$requestKey] as $key => $value) {
                        $assessorProgrammeSection = AssessorProgrammeSection::find($key);

                        $assessorProgrammeSection->update([
                            $column => $value,
                        ]);
                    }
                }
            }

            $assessorProgrammeSection = AssessorProgrammeSection::find($id);

            if (isset($request['panel_score'])) {
                $assessorProgrammeSection->update([
                    'panel_score' => $request['panel_score'],
                ]);
            }

            if (
                $assessorProgrammeSection->assessorProgrammeSubs()->where(function ($q) {
                    $q->whereIn('coppa_requirement', ['no'])
                        ->orWhereIn('evidence_status', ['unavailable', 'irrelevant']);
                })->count() > 0
            ) {
                $assessorProgrammeSection->update([
                    'suggested_score' => '1',
                ]);
            } else if (
                $assessorProgrammeSection->assessorProgrammeSubs()->where('evidence_status', 'format_error')->count() > 0
            ) {
                $assessorProgrammeSection->update([
                    'suggested_score' => '2',
                ]);
            } else if
            (
                $assessorProgrammeSection->assessorProgrammeSubs()->where(function ($q) {
                    $q->whereNotNull('coppa_requirement')
                        ->orWhereNotNull('evidence_status');
                })->count() == 0
            ) {
                $assessorProgrammeSection->update([
                    'suggested_score' => '0',
                ]);
            } else {
                $assessorProgrammeSection->update([
                    'suggested_score' => '3 or more',
                ]);
            }

            DB::commit();
            return redirect()->route('assessors.programme.section.show', ['programme_id' => $programme_id, 'id' => $id])->with('success', 'Data saved successfully.');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            DB::rollback();
        }
    }
}
