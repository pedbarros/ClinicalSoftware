<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pessoa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

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
    /*

    public function edit($id)
    {
        $request = Request::create('/api/pessoa/' . $id, 'GET');
        $Pessoa = json_decode(Route::dispatch($request)->getContent());
//dd($Pessoa);
        $request = Request::create('/api/profissional', 'GET');
        $profissionais = json_decode(Route::dispatch($request)->getContent());
        // dd($profissionais);


        $dia_semana = $this->dia_semana;
        return view('admin.login-pessoa.edit', compact('Pessoa',  'profissionais', 'dia_semana'));
    }

    public function update(Request $request, $id)
    {
        $request = Request::create('/api/pessoa/'.$id, 'PUT', $request->all());
        $Pessoa = json_decode(Route::dispatch($request)->getContent());
        if ($Pessoa) {
            return redirect()
                ->route('login-pessoa.index')
                ->with('success', 'Pessoa atualizado com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao atualizar o Pessoa');
        }
    }

    public function destroy($id)
    {
        $request = Request::create('/api/Pessoa/'.$id, 'DELETE');
        $statusCode = json_decode(Route::dispatch($request)->getStatusCode());
        // dd($statusCode);
        if ($statusCode == 204) { // No Content
            return redirect()
                ->route('login-pessoa.index')
                ->with('success', 'Pessoa apagado com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao apagar o Pessoa');
        }
    }*/
}
