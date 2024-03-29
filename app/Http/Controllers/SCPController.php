<?php

namespace App\Http\Controllers;

use App\Http\Resources\SCPResource;
use App\Models\SCP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SCPController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 0);
        $limit = $request->query('limit', 15);

        return SCPResource::collection(SCP::select(['id', 'id as scp', 'code', 'name', 'description', 'picture', 'category_id'])->with([
            'category' => function($query) {
                $query->select(['id', 'name', 'picture']);
            },
            'enemies' => function ($query) {
                $query->select(['id as scp', 'code', 'name', 'picture'])->limit(2);
            },
            'interviews' => function ($query) {
                $query->select(['scp_id', DB::raw('CONCAT(SUBSTRING(`interview`, 1, 75), "...") as interview'), 'ocurred_on'])
                    ->limit(2);
            }
        ])
        ->limit($limit)
        ->offset($page)
        ->filter($request->query())
        ->get());
    }

    public function find(string $scp_id)
    {
        return new SCPResource(SCP::select(['id', 'id as scp', 'code', 'name', 'description', 'picture', 'category_id'])
            ->where('id', $scp_id)
            ->with([
                'category',
                'enemies' => function ($query) {
                    $query->select(['id as scp', 'code', 'name', 'picture']);
                },
                'interviews' => function ($query) {
                    $query->select(['scp_id', 'scp_id as scp', 'interview', 'ocurred_on']);
                },
            ])->firstOrFail());
    }
}
