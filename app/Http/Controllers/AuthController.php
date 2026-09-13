<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (! Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return response()->json([
                'message' => 'Login gagal',
            ], 401);
        }
        $user = User::where(
            'email',
            $request->email
        )->first();
        $token = $user
            ->createToken('erp-token')
            ->plainTextToken;

        return [
            'token' => $token,
            'user' => $user,
        ];
    }

    public function me(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {
        $request
            ->user()
            ->currentAccessToken()
            ->delete();

        return [
            'success' => true,
        ];
    }
}
