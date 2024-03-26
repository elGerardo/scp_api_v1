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
}
