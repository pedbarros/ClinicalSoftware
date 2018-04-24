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

        try{
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'usuario' => 'required|string|max:255',
                'password' => 'required'
            ]);
//dd($validator->errors());
            if ($validator->fails()) {
                return response()->json(['access' => false, 'error' => 'Os campos não foram validados'], 401);
            }

            $user = User::create($request->all());

            // $user = User::first();
            //$token = JWTAuth::fromUser($user);

            return response()->json($user, 201);
        }catch (\Exception $e){
            dd($e);
        }

    }
}
