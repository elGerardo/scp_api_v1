<?php

namespace App\Http\Controllers;

use App\Http\Resources\SCPEnemiesResource;
use App\Models\SCP;
use Illuminate\Http\Request;

class SCPEnemiesController extends Controller
{
    public function index(Request $request){

        $limit = $request->query('limit', 15);
        $page = $request->query('page', 0);

        return SCPEnemiesResource::collection(SCP::select(['id', 'id as scp', 'code', 'name', 'picture',])
        ->with('enemies', function ($query) {
            $query->select(['id as scp', 'code', 'name', 'picture']);
        })
        ->whereHas('enemies')
        ->limit($limit)
        ->offset($page)
        ->filter($request->query())
        ->get());
    }

    public function find(string $scp_id)
    {
        $scp = SCP::select(['id', 'id as scp', 'code', 'name', 'picture', 'description'])
            ->where('id', $scp_id)
            ->with([
                'enemies' => function ($query) {
                    $query->select(['id as scp', 'code', 'picture', 'description']);
                }
            ])
            ->firstOrFail();
        return new SCPEnemiesResource($scp);
    }
}
