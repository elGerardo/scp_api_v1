<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreSCPRequest;
use App\Http\Requests\UpdateSCPRequest;
use App\Http\Resources\SCPResource;
use App\Models\SCP;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SCPController extends Controller
{
    public function store(StoreSCPRequest $request)
    {
        $payload = $request->validated();
        $code = $payload['id'] < 100 ? 'SCP-0' . $payload['id'] : 'SCP-' . $payload['id'];
        $payload['code'] = $code;
        $scp = SCP::create($payload);
        return new SCPResource($scp);
    }

    public function update(UpdateSCPRequest $request, string $id)
    {
        $scp = SCP::findOrFail($id);
        $payload = $request->validated();
        $scp->update($payload);
        $scp->save();
        return new SCPResource($scp);
    }

    public function getWithIds()
    {
        return SCPResource::collection(SCP::all(['id as value', DB::raw("CONCAT(id, ' - ', name) AS label")]));
    }
}
