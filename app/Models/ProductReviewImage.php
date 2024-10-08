<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReviewImage extends Model
{
    use HasFactory;
    protected $fillable = ['product_review_id', 'image'];


    public function reviews()
    {
        return $this->belongsTo(ProductReview::class);
    }
}
