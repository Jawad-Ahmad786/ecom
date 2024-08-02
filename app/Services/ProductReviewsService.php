<?php

namespace App\Services;

use App\Models\ProductReview;

class ProductReviewsService
{
    public function store($product, $data)
    {
        return $product->reviews()->create($data);
    }
    public function show($product)
    {
        return $product->reviews;
    }
    public function destroy($proudctReviewId)
    {
        ProductReview::findOrFail($proudctReviewId)->delete();
    }
}