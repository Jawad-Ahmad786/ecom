<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductReviews\StoreRequest;
use App\Models\Product;
use App\Models\ProductReview;
use App\Services\ProductReviewsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ProductReviewsController extends Controller
{
  protected ProductReviewsService $productReviewsService;

  public function __construct(ProductReviewsService $productReviewsService)
  {
      $this->productReviewsService = $productReviewsService;
  }
    public function store(StoreRequest $request, Product $product): JsonResponse
  {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $review = $this->productReviewsService->store($product, $data);

        return response()->json([
            'message' => 'Review created successfully',
            'review' => $review
        ], 201);
  }
    public function show(Product $product): JsonResponse
    {
       $reviews = $this->productReviewsService->show($product);
    if($reviews->isEmpty()){
        return response()->json([
            'message' => 'There are no Reviews for this product',
        ], 404);
    }
        return response()->json([
            'message' => 'Getting Product Reviews Successfully',
            'reviews' => $reviews
        ], 200);
    }
  public function destroy(ProductReview $productReview): JsonResponse
  {
      $this->productReviewsService->destroy($productReview->id);

      return response()->json([
          'message' => 'Review deleted successfully',
      ], 200);
  }
}
