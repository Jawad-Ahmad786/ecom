<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\StoreRequest;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Services\OrdersService;
use App\Services\OrderItemsService;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    protected OrdersService $ordersService;

    protected OrderItemsService $orderItemsService;

    public function __construct(OrdersService $ordersService, OrderItemsService $orderItemsService)
    {
        $this->ordersService = $ordersService;
        $this->orderItemsService = $orderItemsService;
    }

    public function index()
    {
        $orders = $this->ordersService->index();

    if($orders->isEmpty())
    {
         return response()->json([
             'message' => 'You have no orders',
         ], 404);
     }
       return response()->json([
             'message' => 'Orders getting Successfully',
             'orders' => $orders
       ], 200);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
    try{
        $order = $this->ordersService->store($data);

        if(!$order)
        {
            return response()->json([
                'message' => 'An error occur while creating order'
            ], 500);
        }

        $orderItems = $this->orderItemsService->store($data, $order);

        if(!$orderItems)
        {
            return response()->json([
                'message' => 'An error occur while creating order items'
            ], 500);
        }

        $pendingStatus = OrderStatus::where('name', 'pending')->first()->id;

        $order->statuses()->attach($pendingStatus);

        DB::commit();

        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order
        ], 201);

    } catch(\Exception $e)
    {
        DB::rollBack();
        return response()->json([
            'message' => 'An error occur while creating order or order items',
        ], 500);
    }
    }
    public function cancel(Order $order)
    {
       $cancelOrder = $this->ordersService->cancel($order);
       if(!$cancelOrder)
       {
           return response()->json([
               'message' => 'Order is already cancelled',
           ], 500);
       }
       return response()->json([
           'message' => 'Order has been cancelled successfully'
       ], 200);
    }
    public function destroy(Order $order)
    {
      try {
          $this->ordersService->destroy($order);
          return response()->json([
              'message' => 'Order deleted successfully',
          ], 200);
      } catch(\Exception $e) {
          return response()->json([
              'message' => 'Order Not Found',
          ], 404);
      }
    }
}
