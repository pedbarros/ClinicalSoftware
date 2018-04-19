<?php

namespace App\Http\Controllers\API;

use App\Models\Pessoa;
use App\Models\Profissional;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfissionalController extends Controller
{
    // SELECT * FROM ALL
    public function index()
    {
        //return response()->json(Profissional::all(), 201);
        return response()->json(Profissional::with('pessoas', 'especialidades', 'planos')->get(), 201);
    }

    // SELECT * FROM ALL WHERE ID = :PARAMS
    public function show($id)
    {
        return response()->json(Profissional::with('pessoas', 'especialidades', 'planos')->find($id), 201);
    }

    // INSERT
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cod_conselho' => 'required|string|max:15',
            'data_entrada' => 'required',
            'especialidade_id' => 'required|integer|max:11',
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
        $profissonal = Profissional::create($request->all());

        return response()->json($profissonal->with('pessoas')->find($profissonal->id), 201);

    }



    // UPDATE
    public function update(Request $request, Profissional $profissional)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            // 'cod_conselho' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Os campos não foram validados'], 401);
        }

        $profissional->update($request->all());

        $profissional->pessoas()->update($request->all());

        return response()->json($profissional->with('pessoas')->find($profissional->id), 200);
    }

    // DELETE
    public function destroy(Profissional $profissional)
    {
        try{
            $profissional->delete();
            $profissional->pessoas->delete();

            return response()->json(null, 204);
        }catch (\Exception $e){
            // dd($e);
            return response()->json(['destroy' => false, 'msg' => 'Não foi possível apagar esse profissional'], 500);
        }

    }
}
