<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ImagesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductImagesController extends Controller
{
    protected ImagesService $imagesService;

    public function __construct(ImagesService $imagesService)
    {
        $this->imagesService = $imagesService;
    }
    public function destroy(Request $request, Product $product): JsonResponse
    {
        $images = json_decode($request->images, true);

        $imagesDeleted = $this->imagesService->deleteImages($product, $images);
        if(!$imagesDeleted){
            return response()->json([
                'message' => 'An issue occurred while deleting images'
            ]);
        }
        return response()->json([
            'message' => 'Images deleted successfully'
        ], 200);
    }
}
