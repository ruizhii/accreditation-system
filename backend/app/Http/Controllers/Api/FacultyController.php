<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FacultyResource;
use App\Models\Faculty;
use App\Http\Requests\StoreFacultyRequest;
use App\Http\Requests\UpdateFacultyRequest;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        if (auth()->user()->cannot('access faculties')) {
            return $this->error('Unauthorized, you don\'t have access.');
        }
        return FacultyResource::collection(Faculty::query()->orderBy('id', 'desc')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Http\Requests\StoreFacultyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFacultyRequest $request)
    {
        if ($request->user()->cannot('create faculties')){
            return $this->error('Unauthorized, you don\'t have access.');
        }
        //$data = $request->file('organizational_chart')->store('public/files');
        $data = $request->validated();
        $faculty = Faculty::create($data);

        return response(new FacultyResource($faculty), 201);
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Faculty $faculty
     * @return \Illuminate\Http\Response
     */
    public function show(Faculty $faculty)
    {
        if (auth()->user()->cannot('access faculties')){
            return $this->error('Unauthorized, you don\'t have access.');
        }
        return new FacultyResource($faculty);
    }

    /**
     * Update the specified resource in storage.
     * @param \App\Http\Requests\UpdateFacultyRequest $request
     * @param \App\Models\Faculty                    $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFacultyRequest $request, Faculty $faculty)
    {
        if ($request->user()->cannot('update faculties', $faculty)){
            return $this->error('Unauthorized, you don\'t have access.');
        }
        $data = $request->validated();
        $faculty->update($data);

        return $faculty;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faculty $faculty)
    {
        if (auth()->user()->cannot('delete faculties', $faculty)){
            return $this->error('Unauthorized, you don\'t have access.');
        }
        $faculty->delete();

        return response("", 204);
    }

}
