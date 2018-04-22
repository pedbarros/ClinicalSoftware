<?php

namespace App\Http\Controllers\API;

use App\Models\Agenda;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgendaController extends Controller
{
    // SELECT * FROM ALL
    public function index()
    {
        //return response()->json(Agenda::all(), 201);
        return response()->json(Agenda::with('paciente', 'paciente.pessoa', 'profissional', 'profissional.pessoas', 'profissional.especialidades')->get(), 201);
    }

    // SELECT * FROM ALL WHERE ID = :PARAMS
    public function show($id)
    {
        return response()->json(Agenda::with('paciente', 'profissional')->find($id), 201);
    }

    // INSERT
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "data_agendamento"=> 'required|string',
            "horario_inicial"=> 'required|string',
            "horario_final"=> 'required|string',
            "obs"=> 'required|string|max:100',
            "status_agendamento" => 'required|string|max:1',
            "profissional_id" => 'required|integer|max:11',
            "paciente_id"=> 'required|integer|max:11',
        ]);
        // dd($validator->errors());

        if ($validator->fails()) {
            return response()->json(['error' => 'Os campos não foram validados'], 401);
        }

        $agenda = Agenda::create($request->all());

        return response()->json($agenda, 201);

    }



    // UPDATE
    public function update(Request $request, Agenda $agenda)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            // 'cod_conselho' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Os campos não foram validados'], 401);
        }

        $agenda->update($request->all());

        return response()->json($agenda, 200);
    }

    // DELETE
    public function destroy(Agenda $agenda)
    {
        try{
            $agenda->delete();

            return response()->json(null, 204);
        }catch (\Exception $e){
            // dd($e);
            return response()->json(['destroy' => false, 'msg' => 'Não foi possível apagar esse Agenda'], 500);
        }

    }
}
