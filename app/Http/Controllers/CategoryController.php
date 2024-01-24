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
        return CategoryResource::collection(Category::all());
    }

    public function find(string $name)
    {
        return new CategoryResource(Category::where('name', $name)->firstOrFail());
    }

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
}
