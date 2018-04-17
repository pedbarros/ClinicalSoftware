<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use JWTFactory;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    /**
     * @var JWTAuth
     */
    private $jwtAuth;

    public function __construct(JWTAuth $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
    }

    /*
     * PROCESSO LOGIN CUSTOMIZADO
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|string|max:255',
            'password' => 'required'
        ]);

        // dd($validator->errors());

        if ($validator->fails()) {
            return response()->json(['access' => false, 'error' => 'Os campos não foram validados'], 401);
        }

        try {
            if (!Auth::attempt(['usuario' => $request->get('usuario'),
                'password' => $request->get('password')], false)) {
                return response()->json(['access' => false, 'error' => 'Credenciais inválidas'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['access' => false, 'error' => 'Não foi possível criar token'], 500);
        }


        $access = true;
        $user = Auth::user();
        $token = $this->jwtAuth->fromUser($user);

        return response()->json(compact('access', 'token', 'user'));
    }

    public function refresh()
    {
        $token = $this->jwtAuth->getToken();
        $token = $this->jwtAuth->refresh($token);

        return response()->json(compact('token'));
    }

    public function logout()
    {
        $token = $this->jwtAuth->getToken();
        $this->jwtAuth->invalidate($token);

        return response()->json(['logout']);
    }

    public function me()
    {
        if (!$user = $this->jwtAuth->parseToken()->authenticate()) {
            return response()->json(['error' => 'user_not_found'], 404);
        }

        return response()->json(compact('user'));
    }

    /*
    * PROCESSO LOGIN PADRÃO
    */
    public function login2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['access' => false, 'error' => 'Os campos não foram validados'], 401);
        }

        $credentials = $request->only('email', 'password');

        try {
            if (!$token = $this->jwtAuth->attempt($credentials)) {
                return response()->json(['access' => false, 'error' => 'Credenciais inválidas'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['access' => false, 'error' => 'Não foi possível criar token'], 500);
        }

        $user = $this->jwtAuth->authenticate($token);

        return response()->json(['access' => true, 'token' => $token, 'user' => $user]);
    }
}


/*
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use JWTFactory;
use JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['access' => false, 'error' => 'Os campos não foram validados'], 401);
        }
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['access' => false, 'error' => 'Credenciais inválidas'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['access' => false, 'error' => 'Não foi possível criar token'], 500);
        }
        return response()->json(['access' => true, 'token' => $token]);
    }
}*/
