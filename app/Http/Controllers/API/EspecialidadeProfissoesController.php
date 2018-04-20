<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\EspecialidadeProfissoesResource;
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
        //dd(json_encode(Profissao::with('especialidades')->get()));
        return response()->json($this->profissao->with('especialidades')->get(), 201);
    }

    /**
     * Store a newly created resource in storage.
     * http://127.0.0.1:8000/api/especialidade/8/profissao/1000 via BODY (status => A ou I)
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($especialidade_id, $profissao_id, Request $request)
    {

        try {
            $especialidade = $this->especialidade->find($especialidade_id);

            $especialidade->profissoes()->attach($profissao_id, ['status' => $request["status"]]);

            return response()->json(['store' => true, 'msg' => 'Inserido com sucesso'], 201);
        } catch (\Exception $e) {
            // dd($e->errorInfo[1]);
            $codigo_erro = $e->errorInfo[1];

            if ($codigo_erro == 1062)
                $msg = "Já existe uma profissão cadastrada a essa especialidade!";
            else
                $msg = "Erro ao cadastrar a profissão a especialidade!";
            return response()->json(['store' => false, 'msg' => $msg], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $especialidade_id
     * @param  int $profissao_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($especialidade_id, $profissao_id)
    {
        // dd($especialidade_id . ' - ' . $profissao_id . "destroy");
        $profissao = $this->profissao->findOrFail($profissao_id);
        $delete = $profissao->especialidades()->detach($especialidade_id);
        if ($delete > 0)
            return response()->json(null, 204);
        else // 417 - Expectativa Falhou
            return response()->json(['error' => 'Não foi possível deletar'], 417);
    }
}
