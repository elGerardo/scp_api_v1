<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::all(['name', 'picture', 'description']));
    }

    public function find(string $name)
    {
        return new CategoryResource(Category::select(['name', 'picture', 'description'])->where('name', $name)->firstOrFail());
    }
}
