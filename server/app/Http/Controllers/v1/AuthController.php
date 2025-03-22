<?php

namespace App\Http\Controllers\v1;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function signup(Request $request)
    {
        try {
            $user = new User;
            $user->full_name = $request['full_name'];
            $user->email = $request['email'];
            $user->password = bcrypt($request['password']);
            $user->save();

            $credentials = [
                "email" => $request['email'],
                'password' => $request['password']
            ];

            $token = Auth::attempt($credentials);
            $user->token = $token;

            return response()->json([
                "success" => true,
                "user" => $user,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ], 500);
        }
    }

    function login(Request $request)
    {
        try {
            $credentials = [
                "email" => $request["email"],
                "password" => $request["password"]
            ];

            if (! $token = Auth::attempt($credentials)) {
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
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ], 500);
        }
    }
}
