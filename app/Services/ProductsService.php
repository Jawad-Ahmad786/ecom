<?php

namespace App\Services;

use App\Models\Product;

class ProductsService
{
    public function index()
    {
//        Query Params
        $brands = json_decode(request('brands'), true);
        $categories = json_decode(request('categories'), true);
        $minPrice = request('min_price');
        $maxPrice = request('max_price');

//        Query For Products
        $products = Product::query();

//        Filter by Brands
        $products->when(request('brands'), function ($query) use($brands) {
                $query->whereIn('brand_id', $brands);
    });

//        Filter by Categories
        $products->when(request('categories'), function ($query) use($categories) {
                $query->whereIn('category_id', $categories);
        });

//        Filter by Min Price
        $products->when(request('min_price'), function ($query) use($minPrice){
            $query->where('price', '>=', $minPrice);
        });

//        Filter by Max Price
        $products->when(request('max_price'), function ($query) use($maxPrice){
            $query->where('price', '<=', $maxPrice);
        });

//        Filter b/w Min and Max Price
        $products->when(request('min_price') && request('max_price'), function ($query) use($minPrice, $maxPrice){
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        });

        return $products->get();
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