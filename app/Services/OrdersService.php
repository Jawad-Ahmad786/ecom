<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Shipment;
use App\Traits\ProductStock;
use Illuminate\Support\Facades\Auth;

class OrdersService
{
    use ProductStock;
    protected CustomerDetailsService $customerDetailsService;
    protected ShipmentsService $shipmentsService;

    public function __construct(ShipmentsService $shipmentsService, CustomerDetailsService $customerDetailsService)
    {
        $this->shipmentsService = $shipmentsService;
        $this->customerDetailsService = $customerDetailsService;
    }
    public function index(): array
    {
        $orders = Order::with('items')->where('user_id', Auth::user()->id)->get();
        $filteredOrders = [];
      foreach ($orders as $order){
          if(!Order::latestPendingOrder($order)){
            $filteredOrders[] = $order;
            }
      }
       return $filteredOrders;
    }
    public function placeOrder(Order $order, int $courierFeeId, string $name, string $email): bool|Shipment
    {
        $processingStatus = OrderStatus::where('name', 'processing')->first()->id;
      if(Order::processing($order)){
           return false;
      }
//     Create Shipment for the order
          $shipment = $this->shipmentsService->store($order->id, $courierFeeId);
          $customerDetails = $this->customerDetailsService->addCustomerDetails($order, $name, $email);
          $order->statuses()->attach($processingStatus);
           return $shipment;
    }
    public function cancel(Order $order): array
    {
        $cancelStatus = OrderStatus::where('name', 'cancelled')->first()->id;

        if(Order::cancelled($order)){
            return [
                 'status' => 'error',
                 'message' => 'Order is already cancelled',
                 'status_code' => 400
            ];
        }
           $this->manageStock($order);
           $order->statuses()->attach($cancelStatus);
           return [
               'status' => 'success',
               'message' => 'Order has been cancelled successfully',
               'status_code' => 200
           ];
    }
    public function destroy(Order $order): bool
    {
        if(Order::completed($order)){
            return false;
        }
//    Checking for order not cancelled to manage stock in this case
        if(!Order::cancelled($order)){
          $this->manageStock($order);
      }
      if($order->shipment){
          $order->shipment()->delete();
      }
        $order->items()->delete();
        $order->payments()->delete();
        $order->statuses()->detach();
        $order->delete();
        return true;
    }
    public function trackOrder(string $tracking_no): bool|OrderStatus
    {
        $order = Auth::user()->orders()->where('tracking_no', $tracking_no)->first();
      if(!$order){
           return false;
      }
        return $order->statuses()->orderBy('pivot_created_at', 'desc')->first();
    }
}