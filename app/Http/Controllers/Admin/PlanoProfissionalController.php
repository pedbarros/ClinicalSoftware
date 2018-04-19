<?php

namespace App\Http\Controllers\Admin;

use App\Models\Profissional;
use App\Models\Plano;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class PlanoProfissionalController extends Controller
{
    private $plano;
    private $profissional;

    public function __construct(Plano $plano, Profissional $profissional)
    {
        $this->plano = $plano;
        $this->profissional = $profissional;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = Request::create('/api/plano', 'GET');
        $planos = json_decode(Route::dispatch($request)->getContent());

        $request = Request::create('/api/profissional', 'GET');
        $profissionais = json_decode(Route::dispatch($request)->getContent());

        $request = Request::create('api/plano/profissional', 'GET');
        $planos_profissionais = json_decode(Route::dispatch($request)->getContent());

        // dd($planos_profissionais);
        return view('admin.plano-profissional.index', compact('planos', 'profissionais', 'planos_profissionais'));
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

        $req = Request::create('/api/plano/' . $request["plano_id"] . '/profissional/' . $request["profissional_id"] , 'POST', $request->all());
        $plano_profissional =  Route::dispatch($req)->getData() ;

        if ($plano_profissional->store == true) {
            return redirect()
                ->route('plano-profissional.index')
                ->with('success', 'Plano adicionado ao profissional com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao inserir o plano ao profissional!');
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
        $plano = $this->plano->find($id);
        return view('admin.plano-profissional.edit', compact('plano'));
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
        $request = Request::create('/api/plano/'.$id, 'PUT', $request->all());
        $plano = json_decode(Route::dispatch($request)->getContent());
// dd($plano);
        if ($plano) {
            return redirect()
                ->route('plano-profissional.index')
                ->with('success', 'Plano atualizado com sucesso!');
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
