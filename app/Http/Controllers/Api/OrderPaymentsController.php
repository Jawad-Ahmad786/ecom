<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderPayments\StoreRequest;
use App\Models\Order;
use App\Services\OrderPaymentsService;
use Illuminate\Http\JsonResponse;

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
        $paymentResponse = $this->orderPaymentsService->store($data, $order);

        if ($paymentResponse['status'] === 'error') {
            return response()->json($paymentResponse['message'], $paymentResponse['status_code']);
        }
        // Handle other successful responses
        return response()->json($paymentResponse, $paymentResponse['status_code']);
    }
}
