<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $req)
    {
        $user = new User();
        if (!$user->validate($req->all())) {
            return response()->json($user->error, 400);
        }
        User::create([
            'email' => $req->input('email'),
            'password' => bcrypt($req->input('password'))
        ]);
        return response()->json(['message' => 'You are were registered successfully'], 201);
    }

    public function login(Request $req)
    {
        $credentials = $req->only('email', 'password');
        if (!auth()->attempt($credentials)) {
            return response()->json('Invalid email or password', 401);
        }
        $token = auth()->user()->createToken('App')->accessToken;
        return response()->json(['accessToken' => $token], 200);
    }

    public function logout(Request $req)
    {
        $req->user()->token()->revoke();
        return response()->json(['message' => 'You are logged out'], 200);
    }
}
