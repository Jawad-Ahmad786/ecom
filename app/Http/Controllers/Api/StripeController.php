<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function publicKey()
    {
        return response()->json([
            'publicKey' => env('STRIPE_KEY'),
        ]);
    }
}
