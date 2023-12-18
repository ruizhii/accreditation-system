<?php

namespace App\Http\Controllers;

use App\Models\AssessorProgramme;
use Illuminate\Http\Request;

class AssessorProgrammeController extends Controller
{
    public function show($id)
    {
        $assessorProgramme = AssessorProgramme::find($id);

        return view('assessors.programmes.show', compact('assessorProgramme'));
    }

    public function summary($id)
    {
        $assessorProgramme = AssessorProgramme::find($id);

        return view('assessors.programmes.summary', compact('assessorProgramme'));
    }

    public function updateStatus($id)
    {
        $assessorProgramme = AssessorProgramme::find($id);

        $assessorProgramme->update([
            'is_completed' => true,
        ]);

        return redirect()->route('assessors.programme.show', ['id' => $id])->with('success', 'Successfully submitted.');
    }
}
