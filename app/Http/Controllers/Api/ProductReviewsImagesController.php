<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use App\Services\ImagesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductReviewsImagesController extends Controller
{
    protected ImagesService $imagesService;

    public function __construct(ImagesService $imagesService){
        $this->imagesService = $imagesService;
    }

    public function destroy(ProductReview $productReview, Request $request): JsonResponse
    {
       if(!(Auth::user()->id === $productReview->user_id)){
            return response()->json([
                'message' => 'You are not authorize to delete these images'
            ], 403);
       }
        $images = json_decode($request->images, true);

            $imagesDeleted = $this->imagesService->deleteImages($productReview, $images);
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
