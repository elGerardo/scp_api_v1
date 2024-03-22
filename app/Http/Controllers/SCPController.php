<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSCPRequest;
use App\Http\Requests\UpdateSCPRequest;
use App\Http\Resources\SCPResource;
use App\Models\SCP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SCPController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 25);
        return SCPResource::collection(SCP::select(['code', 'name', 'description', 'picture', 'category_id'])->orderBy('id')->with([
            'category',
            'enemies' => function ($query) {
                $query->limit(2);
            }, 'interviews' => function ($query) {
                $query->limit(2);
            }
        ])->paginate($page));
    }

    public function find(string $scp_id)
    {
        return new SCPResource(SCP::select(['code', 'name', 'description', 'picture', 'category_id'])->where('id', $scp_id)->with(['category', 'interviews'])->firstOrFail());
    }

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
