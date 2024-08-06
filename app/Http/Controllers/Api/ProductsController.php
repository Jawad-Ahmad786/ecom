<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreRequest;
use App\Http\Requests\Products\UpdateRequest;
use App\Models\Product;
use App\Services\ImagesService;
use App\Services\ProductsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public $directory = 'products';
    protected ImagesService $imagesService;

    protected ProductsService $productsService;
    public function __construct(ImagesService $imagesService, ProductsService $productsService)
    {
        $this->imagesService = $imagesService;
        $this->productsService = $productsService;
    }

    public function index(): JsonResponse
    {
        $products = $this->productsService->index();

     if($products->isEmpty()){
         return response()->json([
             'message' => 'No Products Found',
         ], 404);
     }
        return response()->json([
            'message' => 'Getting Products Successfully',
            'products' => $products
        ], 200);
    }
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();

//      Store Product
        $product = $this->productsService->store($data);

//      Store Product Images
        $this->imagesService->storeImages($product, $this->directory, $data['images'], );

        return response()->json([
            'message' => 'Product Created Successfully',
            'product' => $product
        ], 201);
    }
    public function update(UpdateRequest $request, Product $product): JsonResponse
    {
        $data = $request->validated();
        DB::beginTransaction();
      try {
//        Update Product
          $this->productsService->update($product, $data);

//         Update Product Images
          if ($request->has('images')) {
              $this->imagesService->storeImages($product, $this->directory, $data['images']);
          }
          DB::commit();

          return response()->json([
              'message' => 'Product Updated Successfully',
              'product' => $product
          ], 200);
      } catch(\Exception $e){
          DB::rollback();
          return response()->json([
              'message' => 'An issue occurred while updating',
          ], 500);
      }
    }
    public function destroy(Product $product): JsonResponse
    {
        $this->imagesService->deleteImages($product);
        $this->productsService->destroy($product);
        return response()->json([
           'message' => 'Product Deleted Successfully',
           ], 200);
    }
}
