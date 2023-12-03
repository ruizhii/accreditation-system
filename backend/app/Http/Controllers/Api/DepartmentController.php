<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        if (auth()->user()->cannot('access departments')){
            return $this->error('Unauthorized, you don\'t have access.');
        }
        return DepartmentResource::collection(Department::query()->orderBy('id', 'desc')->paginate(10));    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Http\Requests\StoreDepartmentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartmentRequest $request)
    {
        if ($request->user()->cannot('create departments')){
            return $this->error('Unauthorized, you don\'t have access.');
        }
        $data = $request->validated();
        $department = Department::create($data);

        return response(new DepartmentResource($department), 201);    }

    /**
     * Display the specified resource.
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        if (auth()->user()->cannot('access departments')){
            return $this->error('Unauthorized, you don\'t have access.');
        }
        return new DepartmentResource($department);
    }

    /**
     * Update the specified resource in storage.
     * @param \App\Http\Requests\UpdateDepartmentRequest $request
     * @param \App\Models\Department                    $department
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        if ($request->user()->cannot('update departments', $department)){
            return $this->error('Unauthorized, you don\'t have access.');
        }
        $data = $request->validated();
        $department->update($data);

        return $department;    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        if (auth()->user()->cannot('delete departments')){
            return $this->error('Unauthorized, you don\'t have access.');
        }
        $department->delete();

        return response("", 204);    }
}
