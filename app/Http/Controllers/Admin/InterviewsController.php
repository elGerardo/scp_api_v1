<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreInterviewRequest;
use App\Http\Requests\UpdateInterviewRequest;
use App\Http\Resources\InterviewsResource;
use App\Models\Interviews;
use App\Http\Controllers\Controller;

class InterviewsController extends Controller
{
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
