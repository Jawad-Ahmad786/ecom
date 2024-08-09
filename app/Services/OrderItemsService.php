<?php

namespace App\Services;

use App\Models\Product;

class OrderItemsService
{
    public function store($data, $order)
    {
      try {
          foreach ($data['product_ids'] as $key => $product_id) {
              $unitPrice = Product::find($product_id)->price;
              $quantity = $data['quantity'][$key];
              $order->items()->create([
                  'product_id' => $product_id,
                  'quantity' => $quantity,
                  'unit_price' => $unitPrice,
                  'sub_total' => $unitPrice * $quantity,
              ]);
          }
          return true;

      } catch (\Exception $e){

          return false;
      }

    }
}