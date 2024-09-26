<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ImagesService;
use Illuminate\Http\Request;

class ProductImagesController extends Controller
{
    protected ImagesService $imagesService;

    public function __construct(ImagesService $imagesService)
    {
        $this->imagesService = $imagesService;
    }
    public function destroy(Request $request, Product $product)
    {
        $images = array($request->image_id);
        $imagesDeleted = $this->imagesService->deleteImages($product, $images);
     if(!$imagesDeleted){
         return response()->json([
             'error' => 'An error occurred while deleting images'
         ]);
     }
      return response()->json([
            'message' => 'Images deleted successfully'
      ]);
    }
}
