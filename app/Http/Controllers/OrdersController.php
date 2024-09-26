<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(5);
        return view('orders.index', compact('orders'));
    }
    public function destroy(Order $order)
    {
        $order->items()->delete();
        $order->payments()->delete();
        $order->shipment()->delete();
        $order->statuses()->detach();
        $order->delete();
        return response()->json(['message' => 'Order Deleted Successfully']);
    }
}
