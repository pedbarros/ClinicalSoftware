<?php

namespace App\Http\Controllers\Admin;

use App\Models\Especialidade;
use App\Models\Profissao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class EspecialidadeProfissoesController extends Controller
{
    private $especialidade;
    private $profissao;
    private $status = ["A" => "Ativo", "I" => "Inativo"];

    public function __construct(Especialidade $especialidade, Profissao $profissao)
    {
        $this->especialidade = $especialidade;
        $this->profissao = $profissao;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = Request::create('/api/especialidade', 'GET');
        $especialidades = json_decode(Route::dispatch($request)->getContent());

        $request = Request::create('/api/profissao', 'GET');
        $profissoes = json_decode(Route::dispatch($request)->getContent());

        $request = Request::create('api/especialidade/profissao', 'GET');
        $especialidades_profissoes = json_decode(Route::dispatch($request)->getContent());

        $status = $this->status;

        return view('admin.especialidade-profissao.index', compact('especialidades', 'profissoes', 'especialidades_profissoes', 'status'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $req = Request::create('/api/especialidade/' . $request["especialidade_id"] . '/profissao/' . $request["profissao_id"] , 'POST', $request->all());
        $especialidade_profissao =  Route::dispatch($req)->getData() ;

        if ($especialidade_profissao->store == true) {
            return redirect()
                ->route('especialidade-profissao.index')
                ->with('success', 'Especialidade adicionada a profissão com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', $especialidade_profissao->msg);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // dd($request->all());
        $request = Request::create('/api/especialidade/'. $request["especialidade_id"] .'/profissao/'.$request["profissao_id"], 'DELETE');
        $statusCode =  Route::dispatch($request)->getStatusCode();
 //dd($statusCode);
        if ($statusCode == 204) { // No Content
            return redirect()
                ->route('especialidade-profissao.index')
                ->with('success', 'Especialidades de uma profissão apagada com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao apagar especialidades de uma profissão');
        }
    }
}
