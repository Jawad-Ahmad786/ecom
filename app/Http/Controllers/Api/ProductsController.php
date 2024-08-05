<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreRequest;
use App\Http\Requests\Products\UpdateRequest;
use App\Models\Product;
use App\Services\ProductImagesService;
use App\Services\ProductsService;
use Illuminate\Http\Request;

use function Pest\Laravel\json;

class ProductsController extends Controller
{
    protected ProductImagesService $productImagesService;

    protected ProductsService $productsService;
    public function __construct(ProductImagesService $productImagesService, ProductsService $productsService)
    {
        $this->productImagesService = $productImagesService;
        $this->productsService = $productsService;
    }

    public function index()
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
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

//      Store Product
        $product = $this->productsService->store($data);

//      Store Product Images
        $this->productImagesService->storeImages($product, $data['images']);

        return response()->json([
            'message' => 'Product Created Successfully',
            'product' => $product
        ], 201);
    }
    public function update(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();

//        Update Product
          $this->productsService->update($product, $data);

//         Update Product Images
          $this->productImagesService->storeImages($product, $data['images'], true);

          return response()->json([
              'message' => 'Product Updated Successfully',
              'product' => $product
          ], 200);
    }
    public function destroy(Product $product)
    {
        $this->productImagesService->deleteImages($product);
        $this->productsService->destroy($product);
        return response()->json([
           'message' => 'Product Deleted Successfully',
           ], 200);
    }
}
