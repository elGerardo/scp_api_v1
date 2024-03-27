<?php

namespace App\Http\Controllers;

use App\Http\Resources\InterviewsResource;
use App\Models\Interviews;
use Illuminate\Http\Request;

class InterviewsController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 0);
        $limit = $request->query('limit', 15);
        
        return InterviewsResource::collection(Interviews::filter($request->query())
        ->limit($limit)
        ->offset($page)
        ->get());
    }

    public function getBySCP(Request $request, int $scp_id)
    {
        return InterviewsResource::collection(Interviews::where('scp_id', $scp_id)->filter($request->query())->get());
    }
}
