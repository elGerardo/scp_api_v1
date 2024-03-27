<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 0);
        $limit = $request->query('limit', 15);

        return CategoryResource::collection(Category::select(['name', 'picture', 'description'])
        ->filter($request->query())
        ->limit($limit)
        ->offset($page)
        ->get());
    }

    public function find(string $name)
    {
        return new CategoryResource(Category::select(['name', 'picture', 'description'])->where('name', $name)->firstOrFail());
    }
}
