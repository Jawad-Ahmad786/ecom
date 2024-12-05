<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderPayments\StoreRequest;
use App\Models\Order;
use App\Services\OrderPaymentsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class OrderPaymentsController extends Controller
{
    protected OrderPaymentsService $orderPaymentsService;

    public function __construct(OrderPaymentsService $orderPaymentsService)
    {
        $this->orderPaymentsService = $orderPaymentsService;
    }
    public function store(StoreRequest $request, Order $order): JsonResponse
    {
        $data = $request->validated();
        if(!($order->user_id ===  Auth::user()->id)){
          return response()->json([
              'message' => 'You are not authorize for this action'
          ], 403);
      }
        $paymentResponse = $this->orderPaymentsService->store($data, $order);

        if ($paymentResponse['status'] === 'error') {
            return response()->json($paymentResponse['message'], $paymentResponse['status_code']);
        }
        // Handle other successful responses
        return response()->json($paymentResponse, $paymentResponse['status_code']);
    }
}
