<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\PlaceOrderRequest;
use App\Models\Order;
use App\Services\OrdersService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    protected OrdersService $ordersService;
    public function __construct(OrdersService $ordersService)
    {
        $this->ordersService = $ordersService;
    }

    public function index(): JsonResponse
    {
        $orders = $this->ordersService->index();

    if(empty($orders))
    {
         return response()->json([
             'message' => 'You have no orders',
         ], 404);
     }
       return response()->json([
             'message' => 'Orders getting Successfully',
             'orders' => $orders,
       ], 200);
    }

    public function placeOrder(PlaceOrderRequest $request, Order $order): JsonResponse
    {
        $data = $request->validated();

        $courierFeeId = DB::table('courier_city_fee')
            ->where('city_id', $data['city_id'])
            ->where('courier_id', $data['courier_id'])
            ->first()
            ->id;

        if(!($order->user_id === Auth::user()->id)){
            return response()->json([
                'message' => 'You are not authorized for this action'
            ], 403);
        }

        $shipment = $this->ordersService->placeOrder($order, $courierFeeId);

      if(!$shipment){
          return response()->json([
              'message' => 'Your order is already placed',
              'shipment_details' => $shipment
          ], 302);
      }
        return response()->json([
            'message' => 'Your Order is placed',
            'shipment_details' => $shipment
        ], 200);
    }
    public function cancel(Order $order): JsonResponse
    {
    if(Order::completed($order)){
        return response()->json([
            'message' => 'Completed order cannot be cancelled'
        ], 400);
    }
       $cancelOrder = $this->ordersService->cancel($order);
       if($cancelOrder['status'] === 'error')
       {
           return response()->json(
               $cancelOrder['message'],
               $cancelOrder['status_code']
           );
       }
       return response()->json(
           $cancelOrder['message'],
           $cancelOrder['status_code']);
    }
    public function destroy(Order $order): JsonResponse
    {
        $orderDeleted = $this->ordersService->destroy($order);
       if(!$orderDeleted){
           return response()->json([
               'message' => 'Cannot delete order because it is completed (paid)'
           ], 400);
       }
          return response()->json([
              'message' => 'Order deleted successfully',
          ], 200);
    }
    public function trackOrder(Request $request): JsonResponse
    {
        $order = $this->ordersService->trackOrder($request->tracking_no);
       if(!$order){
           return response()->json([
               'message' => 'Order not found for this tracking number. Please enter a valid tracking number'
           ], 404);
       }
        return response()->json([
            'message' => 'This is your order\'s current status',
             'order' => $order
        ], 200);
    }
}
