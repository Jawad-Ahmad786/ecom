<?php

namespace App\Services;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartsService
{
    public function index(): array
    {
        $orders = Auth::user()->orders()->with('items')->get();
        $cartItems = [];
     foreach($orders as $order){
       if(Order::latestPendingOrder($order)){
           $cartItems[] = $order;
       }
     }
        return $cartItems;
    }
    public function store(array $data): array|Order
    {
        try
        {
            $total = $this->calculateTotal($data['product_ids'], $data['quantity']);

            if($total === 'mismatch'){
                return [
                    'status' => 'error',
                    'message' => 'Product IDs and quantities do not match.',
                    'status_code' => 400
                ];
            }

            if (!$total) {
                return [
                    'status' => 'error',
                    'message' => 'Insufficient stock for one or more products',
                    'status_code' => 400
                ];
            }
            return Order::create([
                'user_id' => Auth::user()->id,
                'tracking_no' => Str::uuid(),
                'grand_total' => $total,
            ]);
        } catch (\Exception $e)
        {
            return [
                'status' => 'error',
                'message' => 'An error occurred while creating the order',
                'status_code' => 500
            ];
        }
    }
    public function update(Order $order, array $data): array|Order
    {
        try {
            $total = $this->calculateTotal($data['product_ids'], $data['quantity']);

            if ($total === 'mismatch') {
                return [
                    'status' => 'error',
                    'message' => 'Product IDs and quantities do not match.',
                    'status_code' => 400
                ];
            }

            if (!$total) {
                return [
                    'status' => 'error',
                    'message' => 'Insufficient stock for one or more products',
                    'status_code' => 400
                ];
            }
            $order->grand_total += $total;
            $order->save();

            return $order;
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'An error occurred while updating the order',
                'status_code' => 500
            ];
        }
    }

    public function calculateTotal(array $ids, array $quantities): int|float
    {
        // Retrieve products and map them by ID to preserve the association
        $products = Product::whereIn('id', $ids)->get()->mapWithKeys(function ($product) {
            return [$product->id => $product];
        });
        $total = 0;

        // Check if the count of products and quantities match
        if (count($products) !== count($quantities)) {
            return 'mismatch';
        }

        foreach ($ids as $index => $id) {
            if (!isset($products[$id])) {
                return 'mismatch'; // Safety check in case a product is missing
            }

            $product = $products[$id];
            $quantity = $quantities[$index];

            if ($quantity > $product->stock) {
                return false; // Insufficient stock
            }

            // Deduct the quantity from the product's stock
            $product->stock -= $quantity;
            $product->save();

            // Calculate the total price
            $total += $product->price * $quantity;
        }
        return $total;
    }
}