<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(
        Request $request
    ) {
        $user = User::where(
            'email',
            $request->email
        )->first();
        if (
            ! $user ||
            ! Hash::check(
                $request->password,
                $user->password
            )
        ) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }
        $token =
            $user
                ->createToken(
                    'erp-token'
                )
                ->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function me(
        Request $request
    ) {
        return $request->user();
    }

    public function logout(
        Request $request
    ) {
        $request
            ->user()
            ->currentAccessToken()
            ?->delete();

        return response()->json([
            'message' => 'logout',
        ]);
    }
}
