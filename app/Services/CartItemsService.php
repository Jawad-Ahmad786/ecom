<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;

class CartItemsService
{
    public function store(array $data, Order $order): bool
    {
      try {
          foreach ($data['product_ids'] as $key => $product_id) {
              $unitPrice = Product::find($product_id)->price;
              $quantity = $data['quantity'][$key];
              $orderItem = $order->items()->where('product_id', $product_id)->first();

              if ($orderItem) {
                  // Update the existing order item by adding the new quantity
                  $newQuantity = $orderItem->quantity + $quantity;
                  $orderItem->update([
                      'product_id' => $product_id,
                      'quantity' => $newQuantity,
                      'unit_price' => $unitPrice,
                      'sub_total' => $unitPrice * $newQuantity,
                  ]);
              } else {
                  // Create a new order item
                  $order->items()->create([
                      'product_id' => $product_id,
                      'quantity' => $quantity,
                      'unit_price' => $unitPrice,
                      'sub_total' => $unitPrice * $quantity,
                  ]);
              }
          }
          return true;

      } catch (\Exception $e){

          return false;
      }
    }
    public function destroy(Order $order, array $data): bool
    {
        try {
            foreach ($data['product_ids'] as $key => $product_id) {
                $product = Product::find($product_id);
                $unitPrice = $product->price;
                $quantity = $data['quantity'][$key];
                $updatedQty = $product->stock + $quantity;
                $product->update([
                    'stock' => $updatedQty
                ]);
                $orderItem = $order->items()->where('product_id', $product_id)->first();

                if ($orderItem) {
                    $newQuantity = $orderItem->quantity - $quantity;
                    if($newQuantity <= 0){
                        $orderItem->delete();
                    }
                    $orderItem->update([
                        'product_id' => $product_id,
                        'quantity' => $newQuantity,
                        'unit_price' => $unitPrice,
                        'sub_total' => $unitPrice * $newQuantity,
                    ]);
                }
            }
            if($order->items()->sum('quantity') === 0){
                $order->items()->delete();
                $order->statuses()->detach();
                $order->delete();
            }
            $order->update([
                'grand_total' => $order->items()->sum('sub_total'),
            ]);
            return true;
        } catch(\Exception $e){
            return false;
        }
    }
}