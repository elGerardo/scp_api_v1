<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function store(StoreCategoryRequest $request)
    {
        return new CategoryResource(Category::create($request->validated()));
    }

    public function update(UpdateCategoryRequest $request, string $name)
    {
        $category = Category::where('name', $name)->firstOrFail();
        $payload = $request->validated();
        $category->update($payload);
        $category->save();
        return new CategoryResource($category);
    }

    public function getWithIds()
    {
        return CategoryResource::collection(Category::all(['id as value', 'name as label']));
    }

    //TODO get scps by category
}
