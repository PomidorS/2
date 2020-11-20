<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $user = new User();
        if (!$user->validate($request->all())) {
            return response()->json($user->error, 400);
        }
        User::create([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
        return response()->json(['message' => 'You are were registered successfully'], 201);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!auth()->attempt($credentials)) {
            return response()->json('Invalid email or password', 401);
        }
        $token = auth()->user()->createToken('App')->accessToken;
        return response()->json(['accessToken' => $token], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'You are logged out'], 200);
    }
}
