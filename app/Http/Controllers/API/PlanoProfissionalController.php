<?php

namespace App\Http\Controllers\API;

use App\Models\Profissional;
use App\Models\Plano;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return response()->json($this->plano->with('profissionais')->get(), 201);
    }

    /**
     * Store a newly created resource in storage.
     * http://127.0.0.1:8000/api/especialidade/8/profissao/1000 via BODY (status => A ou I)
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($plano_id, $profissional_id, Request $request)
    {
        try {
            $plano = $this->plano->find($plano_id);

            $plano->profissionais()->attach($profissional_id, ['status' => $request["status"]]);

            return response()->json(['store' => true, 'msg' => 'Inserido com sucesso'], 201);
        } catch (\Exception $e) {
            // dd($e);
            return response()->json(['store' => false, 'msg' => 'Não foi possível inserir'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $especialidade_id
     * @param  int $profissao_id
     * @return \Illuminate\Http\Response
     */
    public function show($plano_id, $profissional_id)
    {
        // dd($plano_id, $profissional_id);
        $plano = $this->plano->find($plano_id);
        echo "<b>{$plano->nome}:</b><br>";

        $plano->profissionais()->attach($profissional_id);
        //$company->cities()->sync($dataForm);
        // $company->cities()->detach([4]);

        $profissionais = $plano->profissionais;
        foreach ($profissionais as $profissional) {
            echo " {$profissional->descricao}, ";
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $especialidade_id
     * @param  int $profissao_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($plano_id, $profissional_id)
    {
        // dd($plano_id . ' - '. $profissional_id . "destroy");
        $profissional = $this->profissional->findOrFail($profissional_id);
        $delete = $profissional->planos()->detach($plano_id);
        if ($delete > 0)
            return response()->json(null, 204);
        else // 417 - Expectativa Falhou
            return response()->json(['error' => 'Não foi possível deletar'], 417);
    }
}
