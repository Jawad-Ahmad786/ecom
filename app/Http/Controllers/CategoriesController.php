<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\StoreRequest;
use App\Http\Requests\Categories\UpdateRequest;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
      $categories = Category::all();
      return view('categories.index', compact('categories'));
    }
    public function create()
    {
      return view('categories.create');
    }
    public function store(StoreRequest $request)
    {
        Category::create($request->validated());
        return redirect()->route('categories.index')->with(['message' => 'Category added successfully']);
    }
    public function update(UpdateRequest $request, Category $category)
    {
        try {
            $category->update($request->validated());
            return response()->json(['message' => 'Category updated successfully']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // If validation fails, pass the brandId to the session
            return response()->json(['error' => $e->validator]);
        }
    }
    public function destroy(Category $category)
    {
        if($category->products()->count() > 0) {
            return response()->json([
                'message' => 'Cannot delete this category because it has products'
            ]);
        }
        $category->delete();
        return response()->json([
            'message' => 'Category Deleted Successfully'
        ]);
    }
}
