<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
class CitiesController extends Controller
{
    public function index()
    {
        $cities = City::all();
        return response()->json([
            'message' => 'Getting Cities successfully',
            'data' => $cities
        ]);
    }
}
