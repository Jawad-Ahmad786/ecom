<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brands\StoreRequest;
use App\Http\Requests\Brands\UpdateRequest;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;

class BrandsController extends Controller
{
    public function index(): JsonResponse
    {
        $brands = Brand::all();
     if($brands->isEmpty()){
         return response()->json([
             'message' => 'No Brands Found',
         ], 404);
     }
        return response()->json([
            'message' => 'Getting Brands Successfully',
            'brands' => $brands
        ], 200);
    }
   public function store(StoreRequest $request): JsonResponse
   {
        $brand = Brand::create($request->validated());

        return response()->json([
            'message' => 'Brand created successfully.',
             'brand' => $brand
        ], 201);
   }

   public function update(UpdateRequest $request, Brand $brand): JsonResponse
   {
       $brand->update($request->validated());

       return response()->json([
           'message' => 'Brand updated successfully.',
           'brand' => $brand
       ], 200);
   }

   public function destroy(Brand $brand): JsonResponse
   {
       $brand->delete();

       return response()->json([
           'message' => 'Brand deleted successfully.',
       ], 200);
   }

}
