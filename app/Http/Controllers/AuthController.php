<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request) {
        if(!Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = User::where('email', $request['email'])->first();
        
        $tokenResult = $user->createToken('access_token')->plainTextToken;
        return response()->json([
            'token_type' => 'Bearer',
            'access_token' => $tokenResult,
        ]);
    }

}
