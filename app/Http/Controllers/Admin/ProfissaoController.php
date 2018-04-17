<?php

namespace App\Http\Controllers\Admin;

use App\Models\Profissao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as Guzzle;
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
        $profissoes = Route::dispatch($request)->getData();
     //   dd($profissoes);
        return view('admin.profissao.index', compact('profissoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $profissao = Route::dispatch($request)->getData();

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "Entrou no show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profissao = $this->profissao->find($id);
        return view('admin.profissao.edit', compact('profissao'));
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
        $profissao = Route::dispatch($request)->getData();

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
        //
    }
}
