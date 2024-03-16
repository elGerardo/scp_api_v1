<?php

namespace App\Http\Controllers;

use App\Http\Resources\SCPEnemiesResource;
use App\Models\SCP;

class SCPEnemiesController extends Controller
{
    public function find(string $scp_id)
    {
        $scp = SCP::where('id', $scp_id)->with(['enemies'])->firstOrFail();
        return new SCPEnemiesResource($scp);
    }

    public function store(string $scp_id, string $scp_enemy_id)
    {
        $scp = SCP::where('id', $scp_id)->with(['enemies' => function($query) use ($scp_enemy_id) {
            $query->where('scp_enemy_id', $scp_enemy_id);
        }])->firstOrFail();

        if(count($scp->enemies) > 0) {
            return response()->json([ "message" => "SCP's already related" ], 422);
        }

        $scpEnemy = SCP::findOrFail($scp_enemy_id); 
        $scp->enemies()->attach($scpEnemy->id);
        return response()->json([], 204);
    }

    public function destroy(string $scp_id, string $scp_enemy_id)
    {
        $scp = SCP::where('id', $scp_id)->with(['enemies' => function($query) use ($scp_enemy_id) {
            $query->where('scp_enemy_id', $scp_enemy_id);
        }])->firstOrFail();

        $scpEnemy = SCP::findOrFail($scp_enemy_id); 
        $scp->enemies()->detach($scpEnemy->id);
        return response()->json([], 204);
    }
}
