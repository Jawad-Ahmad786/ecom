<?php

namespace App\Services;

use App\Models\Product;

class InventoryService
{
    public function store(string $quantity, Product $product): Product
    {
      $product->update([
            'stock' => $product->stock + intVal($quantity)
       ]);
      return $product;
    }
}