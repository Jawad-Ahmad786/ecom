<?php

namespace App\Http\Controllers;

use App\Http\Requests\Brands\StoreRequest;
use App\Http\Requests\Brands\UpdateRequest;
use App\Models\Brand;

class BrandsController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('brands.index', compact('brands'));
    }
    public function create()
    {
        return view('brands.create');
    }
    public function store(StoreRequest $request)
    {
        Brand::create($request->validated());
        return redirect()->route('brands.index')->with(['message' => 'Brand added successfully']);

    }
    public function update(UpdateRequest $request, Brand $brand)
    {
        try {
            $brand->update($request->validated());
            return response()->json(['message' => 'Brand updated successfully']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // If validation fails, pass the brandId to the session
            return response()->json(['error' => $e->validator]);
        }
    }

    public function destroy(Brand $brand)
    {
     if($brand->products()->count() > 0){
         return response()->json([
             'message' => 'Cannot delete this brand because it has products'
         ]);
     }
        $brand->delete();
        return response()->json([
            'message' => 'Brand Deleted Successfully'
        ]);
    }
}
