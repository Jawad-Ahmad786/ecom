<?php

namespace App\Traits;

use App\Models\Order;
use App\Models\Product;

trait ProductStock
{
    public function manageStock(Order $order): bool
    {
        try {
            $orderItems = $order->items()->get();
            foreach ($orderItems as $item) {
                $product = Product::where('id', $item->product_id)->first();
                $product->stock += $item->quantity;
                $product->save();
            }
            return true;
        } catch(\Exception $e){
            return false;
        }
    }
}
