<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\StoreRequest;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\CartsService;
use App\Services\CartItemsService;

class CartController extends Controller
{
    protected CartsService $cartsService;
    protected CartItemsService $cartItemsService;

    public function __construct(CartsService $cartsService, CartItemsService $cartItemsService)
    {
        $this->cartsService = $cartsService;
        $this->cartItemsService = $cartItemsService;
    }
        public function index(Request $request): JsonResponse
    {
      if($request->header('device_id')){
          $deviceId = $request->header('device_id');
          $orders = $this->cartsService->index($deviceId, null);
      } else{
          $userId = $request->header('user_id');
          $orders = $this->cartsService->index(null, $userId);
      }

        if(empty($orders))
        {
            return response()->json([
                'message' => 'You have no items in cart',
            ], 404);
        }
        return response()->json([
            'message' => 'Orders getting Successfully',
            'orders' => $orders,
        ], 200);
    }
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
         if($request->header('user_id')){
           $userId = $request->header('user_id');
           $user = User::find($userId);
           $orders = $user->orders;
           $data['user_id'] = $userId;
        } else{
         $deviceId = $request->header('device_id');
         $orders = Order::where('device_id', $deviceId)->get();
         $data['device_id'] = $deviceId;
         }
        $pendingStatusId = OrderStatus::where('name', 'pending')->first()->id;
        $pendingOrder = '';
        // Retrieve the user's order that has only the "pending" status
        foreach($orders as $order){
          if(Order::latestPendingOrder($order)){
              $pendingOrder = $order;
          }
        }
        DB::beginTransaction();
        try {
            if ($pendingOrder) {
                // If there's an existing pending order, update it
                $orderResponse = $this->cartsService->update($pendingOrder, $data);
            } else {
                // If no pending order exists, create a new one
                $orderResponse = $this->cartsService->store($data);
            }

            if ($orderResponse['status'] === 'error') {
                return response()->json(
                    $orderResponse['message'],
                    $orderResponse['status_code']
                );
            }
            $orderItems = $this->cartItemsService->store($data, $orderResponse);

            if (!$orderItems) {
                return response()->json([
                    'message' => 'An error occurred while creating order items'
                ], 500);
            }

            // Attach the pending status to the order if it's newly created
            if (!$pendingOrder) {
                $orderResponse->statuses()->attach($pendingStatusId);
            }

            DB::commit();

            return response()->json([
                'message' => 'Order created/updated successfully',
                'order' => $orderResponse
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'An error occurred while creating/updating the order',
            ], 500);
        }
    }

    public function destroy(Request $request): JsonResponse
    {
      if($request->header('user_id')){
          $userId = $request->header('user_id');
          $user = User::find($userId);;
          $userOrders = $user->orders;
      } else{
          $deviceId = $request->header('device_id');
          $userOrders = Order::where('device_id', $deviceId)->get();
      }
        $pendingOrder = null;

        foreach ($userOrders as $order) {
            if (Order::latestPendingOrder($order)) {
                $pendingOrder = $order;
            }
        }
        if (!is_null($pendingOrder)) {
            // Fetch order items matching the product_ids within the pending order
            $matchingOrderItems = $this->cartItemsService->destroy($pendingOrder, $request->all());
            if(!$matchingOrderItems){
                return response()->json([
                    'message' => 'An issue occurred while deleting cart items'
                ], 500);
            }
        } else {
            return response()->json([
                 'message' => 'No items in the cart to remove',
            ], 400);
        }
        return response()->json([
            'message' => 'Items has been removed from the cart'
        ], 200);
    }
}
