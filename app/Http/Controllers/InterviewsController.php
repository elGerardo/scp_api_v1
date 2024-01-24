<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInterviewRequest;
use App\Http\Requests\UpdateInterviewRequest;
use App\Http\Resources\InterviewsResource;
use App\Models\Interviews;

class InterviewsController extends Controller
{
    public function index()
    {
        return InterviewsResource::collection(Interviews::all());
    }

    public function getBySCP(int $scp_id)
    {
        return InterviewsResource::collection(Interviews::where('scp_id', $scp_id)->get());
    }

    public function store(StoreInterviewRequest $request)
    {
        return new InterviewsResource(Interviews::create($request->validated()));
    }

    public function update(UpdateInterviewRequest $request, int $id)
    {
        $interview = Interviews::findOrFail($id);
        $payload = $request->validated();
        $interview->update($payload);
        $interview->save();
        return new InterviewsResource($interview);
    }
}
