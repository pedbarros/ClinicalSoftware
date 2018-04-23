<?php

namespace App\Http\Controllers\API;

use App\Models\Pessoa;
use App\Models\Paciente;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PacienteController extends Controller
{
    // SELECT * FROM ALL
    public function index()
    {
        //return response()->json(Paciente::all(), 201);
        return response()->json(Paciente::with('pessoas', 'plano')->get(), 201);
    }

    // SELECT * FROM ALL WHERE ID = :PARAMS
    public function show($id)
    {
        return response()->json(Paciente::with('pessoas', 'plano')->find($id), 201);
    }

    // INSERT
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'data_entrada' => 'required',
                'plano_id' => 'required|integer|max:11',
                'nome' => 'required|string|max:50',
                'sexo' => 'required|string|max:2',
                'data_nascimento' => 'required|string',
                'telefone' => 'required|string|max:15',
                'cpf' => 'required|string|max:15',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => 'Os campos não foram validados'], 401);
            }

            $pessoa = Pessoa::create($request->all());
            $request["pessoa_id"] = $pessoa->id;
            $profissonal = Paciente::create($request->all());

            return response()->json($profissonal->with('pessoas')->find($profissonal->id), 201);
        }catch (\Exception $e){
            dd($e);
        }


    }

    // UPDATE
    public function update(Request $request, Paciente $paciente)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            // 'plano_id' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Os campos não foram validados'], 401);
        }

        $paciente->update($request->all());

        $paciente->pessoa()->update($request->all());

        return response()->json($paciente->with('pessoas')->find($paciente->id), 200);
    }

    // DELETE
    public function destroy(Paciente $paciente)
    {
        try{
            $paciente->delete();
            $paciente->pessoa->delete();

            return response()->json(null, 204);
        }catch (\Exception $e){
            // dd($e);
            return response()->json(['destroy' => false, 'msg' => 'Não foi possível apagar esse paciente'], 500);
        }

    }
}
