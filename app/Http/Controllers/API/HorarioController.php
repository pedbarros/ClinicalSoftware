<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Models\Horario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HorarioController extends Controller
{
    // SELECT * FROM ALL
    public function index()
    {
        //dd(Horario::all()->first()->profissionais()->first()->pessoas());
        return response()->json(Horario::with('profissionais', 'profissionais.pessoas', 'profissionais.especialidades')->get(), 201);
    }

    // INSERT
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dia_semana' => 'required|integer|max:2',
            /*'horario_inicio' => 'required|string|max:255',
            'horario_final' => 'required|string|max:255',
            'quantidade_consultas' => 'required|string|max:255',*/
            'profissional_id' => 'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Os campos não foram validados'], 401);
        }

        $horario = Horario::create($request->all());

        return response()->json($horario, 201);
    }

    // SELECT * FROM ALL WHERE ID = :PARAMS
    /*public function show(Request $request, $id)
    {
        $horario = Horario::with('profissionais')->find($id);
        return response()->json($horario, 201);
    }*/

    public function obterHorarioMedico($id, Request $request)
    {

        $horario = Horario::with('profissionais', 'profissionais.pessoas', 'profissionais.especialidades')
                          ->where('profissional_id', $id);

        if (isset($request["dia_semana"]))
            $horario->where('dia_semana', $request["dia_semana"]);

        return response()->json($horario->get(), 201);
    }



    // UPDATE
    public function update(Request $request, Horario $horario)
    {
        $validator = Validator::make($request->all(), [
            'dia_semana' => 'required|string|max:255'
        ]);
//dd($validator->errors());
        if ($validator->fails()) {
            return response()->json(['error' => 'Os campos não foram validados'], 401);
        }

        $horario->update( $request->all() );

        return response()->json($horario, 200);
    }

    // DELETE
    public function destroy(Horario $horario)
    {
        $horario->delete();

        return response()->json(null, 204);
    }
}
