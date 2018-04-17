<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;

class RegisterController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'GP_USUARIO' => 'required|string|max:255|unique:gp_user',
            'GP_PASSWORD' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['access' => false, 'error' => 'Os campos não foram validados'], 401);
        }

        User::create([
            'GP_USUARIO' => $request->get('GP_USUARIO'),
            'GP_PASSWORD' => bcrypt($request->get('GP_PASSWORD')),
        ]);

        $user = User::first();
        $token = JWTAuth::fromUser($user);

        return Response::json(compact('token'));
    }
}
