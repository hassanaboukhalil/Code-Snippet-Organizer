<?php

namespace App\Http\Controllers\v1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function signup(Request $request)
    {
        $user = new User;
        $user->full_name = $request['full_name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->save();

        return response()->json([
            "success" => true
        ]);
    }

    function login(Request $request)
    {
        $credentials = [
            "email" => $request['email'],
            'password' => $request['password']
        ];

        $token = Auth::attempt($credentials);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json([
                "success" => false,
                "error" => "Unauthorized"
            ], 401);
        }

        $user = Auth::user();
        $user->token = $token;

        return response()->json([
            "success" => true,
            "user" => $user
        ]);
    }
}
