<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrdersService
{

    public function index()
    {
        return Auth::user()->orders()->with('items')->get();

    }

    public function store($data)
    {
        try
        {
            return Order::create([
                'user_id' => Auth::user()->id,
                'tracking_no' => Str::uuid(),
                'grand_total' => $this->calculateTotal($data['product_ids'], $data['quantity']),
            ]);
        } catch (\Exception $e)
        {
            return false;
        }
    }
    public function calculateTotal($ids, $quantities)
    {
         $products = Product::whereIn('id', $ids)->get();
         $total = 0;
       foreach($products as $key => $product){
           $quantity = $quantities[$key];
           $total += $product->price * $quantity;
       }
        return $total;
    }

    public function cancel($order)
    {
        $cancelStatus = OrderStatus::where('name', 'cancelled')->first()->id;
         if($order->statuses()->where('order_status_id', $cancelStatus)->exists()){
             return false;
         }
           $order->statuses()->attach($cancelStatus);
           return true;
    }
    public function destroy($order)
    {
        $order->items()->delete();
        $order->statuses()->detach();
        $order->delete();
        return true;
    }
}