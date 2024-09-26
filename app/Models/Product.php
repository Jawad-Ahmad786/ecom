<?php

namespace App\Models;

use App\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
                        'name',
                        'slug',
                        'sku',
                        'description',
                        'short_description',
                        'price',
                        'stock',
                        'status',
                        'featured',
                        'discount',
                        'category_id',
                        'brand_id'
                    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }
    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    protected function casts()
    {
        return [
            'status' => ProductStatus::class
        ];
    }
}
