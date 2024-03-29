<?php

namespace App\Http\Controllers\Admin;

use App\Models\SCP;
use App\Http\Controllers\Controller;

class SCPEnemiesController extends Controller
{
    public function store(string $scp_id, string $scp_enemy_id)
    {
        $scp = SCP::where('id', $scp_id)->with(['enemies' => function($query) use ($scp_enemy_id) {
            $query->where('scp_enemy_id', $scp_enemy_id);
        }])->firstOrFail();

        if(count($scp->enemies) > 0) {
            return response()->json([ "message" => "SCP's already related" ], 422);
        }

        $scpEnemy = SCP::where('id', $scp_enemy_id)->with(['enemies'])->firstOrFail();
        
        $scp->enemies()->attach($scpEnemy->id);
        $scpEnemy->enemies()->attach($scp->id);
        
        return response()->json([], 204);
    }

    public function destroy(string $scp_id, string $scp_enemy_id)
    {
        $scp = SCP::where('id', $scp_id)->with(['enemies' => function($query) use ($scp_enemy_id) {
            $query->where('scp_enemy_id', $scp_enemy_id);
        }])->firstOrFail();

        $scpEnemy = SCP::where('id', $scp_enemy_id)->with(['enemies'])->firstOrFail();

        $scp->enemies()->detach($scpEnemy->id);
        $scpEnemy->enemies()->detach($scp->id);

        return response()->json([], 204);
    }
}
