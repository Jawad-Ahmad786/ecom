<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class SessionController extends Controller
{
    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(6)]
        ]);

        if(! Auth::attempt($attributes)) {
                return response()->json([
                    'message' => 'These Credentials do not match our records.'
                ], 404);
        }

        $user = User::where('email', request('email'))->first();
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'message' => 'Login Successfully'
        ], 200);
    }
    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout Successfully'
        ], 200);
    }
}