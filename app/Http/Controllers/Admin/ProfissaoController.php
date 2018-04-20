<?php

namespace App\Http\Controllers\Admin;

use App\Models\Profissao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class ProfissaoController extends Controller
{
    private $profissao;

    public function __construct(Profissao $profissao)
    {
        $this->profissao = $profissao;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = Request::create('/api/profissao', 'GET');
        $profissoes = json_decode(Route::dispatch($request)->getContent());

        return view('admin.profissao.index', compact('profissoes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = Request::create('/api/profissao', 'POST', $request->all());
        $profissao = json_decode(Route::dispatch($request)->getContent());

        if ($profissao) {
            return redirect()
                ->route('profissao.index')
                ->with('success', 'Profissão inserida com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao inserir');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $request = Request::create('/api/profissao', 'GET');
        $profissoes = json_decode(Route::dispatch($request)->getContent());

        $request = Request::create('/api/profissao/'.$id, 'GET', $request->all());
        $profissao = json_decode(Route::dispatch($request)->getContent());

        return view('admin.profissao.edit', compact('profissao', 'profissoes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request = Request::create('/api/profissao/'.$id, 'PUT', $request->all());
        $profissao = json_decode(Route::dispatch($request)->getContent());
// dd($profissao);
        if ($profissao) {
            return redirect()
                ->route('profissao.index')
                ->with('success', 'Profissão atualizada com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao atualizar');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = Request::create('/api/profissao/'.$id, 'DELETE');
        $statusCode = json_decode(Route::dispatch($request)->getStatusCode());
        //dd($statusCode);
        if ($statusCode == 204) { // No Content
            return redirect()
                ->route('profissao.index')
                ->with('success', 'Profissão apagada com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao apagar');
        }
    }
}
