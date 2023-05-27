<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthenticationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function login(StoreAuthenticationRequest $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;
            return response()->json([
                'user' => $user,
                'token' => $token
            ]);
        }
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }

    public function users(Request $request){
        $users = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make($request->password)
        ]);
        $token = $users->createToken('API Token')->plainTextToken;

        return response()->json(['success' =>true, 'data' => $users,'token'=>$token],201);
    }
}
