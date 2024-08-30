<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Support\Collection;

class ProductReviewsService
{
    public function store(Product $product, array $data): ProductReview
    {
        return $product->reviews()->create($data);
    }
    public function show(Product $product): Collection
    {
        return $product->reviews;
    }
    public function destroy(int $proudctReviewId): void
    {
        ProductReview::findOrFail($proudctReviewId)->delete();
    }
}