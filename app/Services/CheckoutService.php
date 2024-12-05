<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Checkout\Session;
class CheckoutService
{
    public function createCheckoutSession($order, $lineItems, $successUrl, $cancelUrl)
    {
        // Set the API key within the method
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        // Create and return the Stripe Checkout session
        return Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => $successUrl,
            'cancel_url' => $cancelUrl,
            'metadata' => [
                    'order_id' => $order->id
            ]
        ]);
    }
}