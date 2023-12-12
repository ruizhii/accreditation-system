<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccreditationResource;
use App\Models\Accreditation;
use App\Http\Requests\StoreAccreditationRequest;
use App\Http\Requests\UpdateAccreditationRequest;

class AccreditationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        if (auth()->user()->cannot('access accreditations')){
            return $this->error('Unauthorized, you don\'t have access.');
        }
        return AccreditationResource::collection(Accreditation::query()->orderBy('id', 'desc')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Http\Requests\StoreAccreditationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccreditationRequest $request)
    
    {
        if ($request->user()->cannot('create accreditations')){
            return $this->error('Unauthorized, you don\'t have access.');
        }
        $data = $request->validated();
        $accreditation = Accreditation::create($data);

        return response(new AccreditationResource($accreditation), 201);
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Accreditation $accreditation
     * @return \Illuminate\Http\Response
     */
    public function show(Accreditation $accreditation)
    {
        if (auth()->user()->cannot('access accreditations')){
            return $this->error('Unauthorized, you don\'t have access.');
        }
        return new AccreditationResource($accreditation);  
    }

    /**
     * Update the specified resource in storage.
     * @param \App\Http\Requests\UpdateAccreditationRequest $request
     * @param \App\Models\Accreditation                   $accreditation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccreditationRequest $request, Accreditation $accreditation)
    {
        if ($request->user()->cannot('update accreditations', $accreditation)){
            return $this->error('Unauthorized, you don\'t have access.');
        }
        $data = $request->validated();
        $accreditation->update($data);

        return $accreditation;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accreditation $accreditation)
    {
        if (auth()->user()->cannot('delete accreditations')){
            return $this->error('Unauthorized, you don\'t have access.');
        }
        $accreditation->delete();

        return response("", 204);
    }
}
