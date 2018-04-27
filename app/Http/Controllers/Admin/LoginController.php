<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pessoa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class LoginController extends Controller
{
    private $pessoa;

    public function __construct(Pessoa $pessoa)
    {
        $this->pessoa = $pessoa;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = Request::create('/api/nivel-acesso', 'GET');
        $niveis = json_decode(Route::dispatch($request)->getContent());

        $request = Request::create('/api/list-users', 'GET');
        $list_users = json_decode(Route::dispatch($request)->getContent());

       // dd($niveis);
        return view('admin.login-pessoa.index', compact('niveis', 'list_users'));
    }


    public function store(Request $request)
    {
        $request["nivel_id"] = (string) json_decode($request["nivel_id"])->id;

        $request = Request::create('/api/auth/register', 'POST', $request->all());
        $pessoa = json_decode(Route::dispatch($request)->getContent());

        // dd($pessoa);

        if ($pessoa) {
            return redirect()
                ->route('login-pessoa.index')
                ->with('success', 'Usuário vinculado a pessoa com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao vincular');
        }

    }

    function auth(Request $request, JWTAuth $jwtAuth) {
        // dd($request->all());
        try {
            if (Auth::attempt(['usuario' => $request->get('usuario'), 'password' => $request->get('password')], false)) {
                $user = Auth::user();
                $token = $jwtAuth->fromUser($user);
                // session('token');
                session(['token' => $token]);
                // dd($token);
                return redirect()->route('home');
            } else {
                return "Incorreta parceiro!";
            }
        } catch (JWTException $e) {
            return response()->json(['access' => false, 'error' => 'Não foi possível criar token'], 500);
        }
    }

}
