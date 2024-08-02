<?php

namespace App\Services;

use App\Models\Product;

class ProductsService
{
    public function index()
    {
        return Product::all();
    }
    public function store($data)
    {
        return Product::create($data);
    }
    public function update($product, $data)
    {
        return $product->update($data);
    }
    public function destroy($product)
    {
        $product->delete();
    }
}