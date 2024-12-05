<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;

class CardPaymentsController extends Controller
{
    public function showPaymentForm()
    {
        return view('card-payments.create', ['orderId' => request()->orderId]);
    }
    public function createPaymentIntent(Request $request)
    {
        // Ensure the Stripe secret key is set
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $orderId = $request->items[0]['id'];
        $order = Order::find($orderId);
        if(!$order){
            return response()->json([
                'message' => 'Order Not Found'
            ], 404);
        }
//        if(!(Auth::user()->id === $order->user_id)){
//         return response()->json([
//             'message' => 'You are not authorized for this action'
//         ], 403);
//     }
       if(Order::latestPendingOrder($order) || Order::cancelled($order)){
           return response()->json([
               'message' => 'Cannot proceed to payment'
           ], 500);
       }
       if(Order::completed($order)){
           return response()->json([
               'message' => 'Order is already paid'
           ], 400);
       }

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $order->pending_total,
                'currency' => 'usd',
                'metadata' => ['order_id' => $orderId],
            ]);
            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function paymentComplete(Request $request)
    {
        try{
            $order = Order::find($request->order_id);
            $completedStatus = OrderStatus::where('name', 'completed')->first()->id;
            $order->statuses()->attach($completedStatus);
            $order->payments()->create([
                'payment_method_id' => 3,
                'payment_status_id' => 1,
                'paid_amount' => $order->pending_total
            ]);
            return response()->json([
                'message' => 'Your payment has been successfully done'
            ], 200);
        } catch(\Exception $e){
             return response()->json([
                 'message' => 'An error occurred'
             ], 500);
        }

    }
}
