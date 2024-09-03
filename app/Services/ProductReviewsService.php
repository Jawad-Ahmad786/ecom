<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Support\Collection;

class ProductReviewsService
{
    protected ImagesService $imagesService;

    public function __construct(ImagesService $imagesService)
    {
        $this->imagesService = $imagesService;
    }
    public function store(Product $product, array $data): ProductReview
    {
        return $product->reviews()->create($data);
    }
    public function update(ProductReview $productReview, array $data): bool
    {
        return $productReview->update($data);
    }
    public function show(Product $product): Collection
    {
        return $product->reviews;
    }
    public function destroy(int $proudctReviewId): bool
    {
     try{
         $productReview = ProductReview::findOrFail($proudctReviewId);
         if($productReview->images){
             $this->imagesService->deleteImages($productReview);
         }
         $productReview->delete();
         return true;
     }catch (\Exception $e){
         return false;
     }


    }
}