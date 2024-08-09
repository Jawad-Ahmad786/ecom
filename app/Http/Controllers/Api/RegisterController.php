<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $userAttributes = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(6)],
            'mobile_no' => ['required'],
            'address' => ['required'],
            'city_id' => ['required', 'exists:cities,id']
        ]);

        $user = User::create($userAttributes);

        return response()->json([
             'message' => 'Registered Successfully'
        ], 201);
    }
}