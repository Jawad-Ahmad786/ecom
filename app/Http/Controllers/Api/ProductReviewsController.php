<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductReviews\StoreRequest;
use App\Models\Product;
use App\Models\ProductReview;
use App\Services\ProductReviewsService;
use Illuminate\Http\Request;

class ProductReviewsController extends Controller
{
  protected ProductReviewsService $productReviewsService;

  public function __construct(ProductReviewsService $productReviewsService)
  {
      $this->productReviewsService = $productReviewsService;
  }

    public function store(StoreRequest $request, Product $product)
  {
        $data = $request->validated();

        $this->productReviewsService->store($product, $data);

        return response()->json([
            'message' => 'Review created successfully',
        ], 201);
  }
    public function show(Product $product)
    {
       $reviews = $this->productReviewsService->show($product);

        return response()->json([
            'message' => 'Getting Product Reviews Successfully',
            'reviews' => $reviews
        ]);
    }
  public function destroy(ProductReview $productReview)
  {
      $this->productReviewsService->destroy($productReview->id);

      return response()->json([
          'message' => 'Review deleted successfully',
      ], 200);
  }
}
