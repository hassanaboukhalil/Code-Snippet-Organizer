<?php

namespace App\Http\Controllers\v1;

use App\Models\User;
use Illuminate\Http\Request;

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
}
