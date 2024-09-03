<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductReviews\StoreRequest;
use App\Http\Requests\ProductReviews\UpdateRequest;
use App\Models\Product;
use App\Models\ProductReview;
use App\Services\ImagesService;
use App\Services\ProductReviewsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductReviewsController extends Controller
{
    public $directory = 'product-reviews';
    protected ImagesService $imagesService;

  protected ProductReviewsService $productReviewsService;

  public function __construct(ProductReviewsService $productReviewsService, ImagesService $imagesService)
  {
      $this->productReviewsService = $productReviewsService;
      $this->imagesService = $imagesService;
  }
    public function store(StoreRequest $request, Product $product): JsonResponse
  {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        DB::beginTransaction();
      try{
          $review = $this->productReviewsService->store($product, $data);
          if($request->has('images')){
              $this->imagesService->storeImages($review, $this->directory, $request->images);
          }
          DB::commit();
          return response()->json([
              'message' => 'Review created successfully',
              'review' => $review
          ], 201);
      }  catch (\Exception $e){
          DB::rollback();
          return response()->json([
              'message' => 'An error occurred while creating review',
          ], 500);
      }

  }
  public function update(UpdateRequest $request, ProductReview $productReview)
  {
        $data = $request->validated();
        DB::beginTransaction();
      try{
          $updateReview = $this->productReviewsService->update($productReview, $data);
          if($request->has('images')){
              $this->imagesService->storeImages($productReview, $this->directory, $request->images);
          }
          DB::commit();
          return response()->json([
              'message' => 'Review Updated Successfully',
              'review' => $updateReview
          ], 200);
      }  catch(\Exception $e){
          DB::rollback();
          return response()->json([
              'message' => 'An issue occurred',
          ], 500);
      }
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
     DB::beginTransaction();
   try{
       $this->productReviewsService->destroy($productReview->id);
       DB::commit();
       return response()->json([
           'message' => 'Review deleted successfully',
       ], 200);
   }  catch(\Exception $e){
       DB::rollback();
       return response()->json([
           'message' => 'An issue occurred while deleting review and images',
       ], 200);
   }
  }
}
