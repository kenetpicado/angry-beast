<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return inertia('Dashboard/Category/Index', [
            'categories' => Category::paginate(),
        ]);
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());

        return back();
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return back();
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return back();
    }
}
