<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AcademicProgrammeResource;
use App\Models\AcademicProgramme;
use App\Http\Requests\StoreAcademicProgrammeRequest;
use App\Http\Requests\UpdateAcademicProgrammeRequest;

class AcademicProgrammeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        if (auth()->user()->cannot('access programmes')){
            return $this->error('Unauthorized, you don\'t have access.');
        }
        return AcademicProgrammeResource::collection(AcademicProgramme::query()->orderBy('id', 'desc')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Http\Requests\StoreAcademicProgrammeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAcademicProgrammeRequest $request)
    {
        if ($request->user()->cannot('create programmes')){
            return $this->error('Unauthorized, you don\'t have access.');
        }
        $data = $request->validated();
        $academicProgramme = AcademicProgramme::create($data);

        return response(new AcademicProgrammeResource($academicProgramme), 201);
    }

    /**
     * Display the specified resource.
     * @param \App\Models\AcademicProgramme $academicProgramme
     * @return \Illuminate\Http\Response
     */
    public function show(AcademicProgramme $academicProgramme)
    {
        if (auth()->user()->cannot('access programmes')){
            return $this->error('Unauthorized, you don\'t have access.');
        }
        return new AcademicProgrammeResource($academicProgramme);    
    }

    /**
     * Update the specified resource in storage.
     * @param \App\Http\Requests\UpdateAcademicProgrammeRequest $request
     * @param \App\Models\AcademicProgramme                    $academicProgramme
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAcademicProgrammeRequest $request, AcademicProgramme $academicProgramme)
    {
        if ($request->user()->cannot('update programmes', $academicProgramme)){
            return $this->error('Unauthorized, you don\'t have access.');
        }
        $data = $request->validated();
        $academicProgramme->update($data);

        return $academicProgramme;    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicProgramme $academicProgramme)
    {
        if (auth()->user()->cannot('delete programmes')){
            return $this->error('Unauthorized, you don\'t have access.');
        }
        $academicProgramme->delete();

        return response("", 204);
    }
}
