<?php

namespace App\Http\Controllers;

use App\Http\Resources\SCPEnemiesResource;
use App\Models\SCP;

class SCPEnemiesController extends Controller
{
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
