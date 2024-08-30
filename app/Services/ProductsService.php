<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductsService
{
    public function index(): Collection
    {
        return Product::all();
    }
    public function store(array $data): Product
    {
        return Product::create($data);
    }
    public function update(Product $product, array $data): bool
    {
        return $product->update($data);
    }
    public function destroy(Product $product): void
    {
        $product->delete();
    }
}