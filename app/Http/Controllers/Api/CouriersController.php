<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Courier;
class CouriersController extends Controller
{
    public function index()
    {
        $couriers = Courier::all();
        return response()->json([
            'message' => 'Getting Couriers successfully',
            'data' => $couriers
        ]);
    }
}
