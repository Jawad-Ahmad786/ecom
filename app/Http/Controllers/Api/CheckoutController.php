<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Services\CheckoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    protected CheckoutService $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    public function checkout(Request $request)
    {
          $order = Order::where('id', $request->order_id)->first();
        if(!$order){
            return response()->json([
                'message' => 'Order Not Found'
            ], 404);
        }
        if(!(Auth::user()->id === $order->user_id )){
            return response()->json([
                'message' => 'you are not authorized for this action'
            ], 403);
        }
        if(Order::cancelled($order) || Order::latestPendingOrder($order)){
            return response()->json([
                'message' => 'Cannot proceed to checkout'
            ], 400);
        }
        if(Order::completed($order)){
            return response()->json([
                'message' => 'Order is already paid'
            ], 400);
        }
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'unit_amount' => $order->pending_total * 100,
                        'product_data' => [
                            'name' => 'Payment for order',
                        ],
                    ],
                    'quantity' => 1,
                ];

        // Set the success and cancel URLs
        $successUrl = route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}';
        $cancelUrl = route('checkout.cancel', ['order_id' => $order->id]);

        // Create the Stripe Checkout session
        $session = $this->checkoutService->createCheckoutSession(
            $order,
            $lineItems,
            $successUrl,
            $cancelUrl
        );

        // Save the session ID in the order

        $order->stripe_session_id = $session->id;
        $order->save();

        return response()->json(['session' => $session]);
    }
    public function success(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $sessionId = $request->query('session_id');
        $session = Session::retrieve($sessionId);
        $order = Order::where('id', $session->metadata->order_id)->first();

        $completedStatus = OrderStatus::where('name', 'completed')->first();

        $order->statuses()->attach($completedStatus);

        $order->payments()->create([
            'payment_status_id' => 1,
            'payment_method_id' => 3,
            'paid_amount' => $order->pending_total
        ]);

        return response()->json([
            'message' => 'Payment has been done successfully',
            'order_details' => $order,
            'order_payments' => $order->payments
        ], 200);
    }
    public function cancel()
    {
        return response()->json([
            'message' => 'Payment has been cancelled. Please try again'
        ], 500);
    }
}
