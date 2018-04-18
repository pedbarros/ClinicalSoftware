<?php

namespace App\Http\Controllers\API;

use App\Models\Especialidade;
use App\Models\Profissao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EspecialidadeProfissoesController extends Controller
{

    private $especialidade;
    private $profissao;

    function __construct(Especialidade $especialidade, Profissao $profissao)
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
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $especialidade_id
     * @param  int  $profissao_id
     * @return \Illuminate\Http\Response
     */
    public function show($especialidade_id, $profissao_id) {
        dd($especialidade_id . ' - ' . $profissao_id);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $especialidade_id
     * @param  int  $profissao_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($especialidade_id, $profissao_id) {
        $profissao = $this->profissao->findOrFail($profissao_id);
        $delete = $profissao->especialidades()->detach($especialidade_id);
        if ($delete > 0)
            return response()->json(null, 204);
        else // 417 - Expectativa Falhou
            return response()->json(['error' => 'Não foi possível deletar'], 417);
    }
}
