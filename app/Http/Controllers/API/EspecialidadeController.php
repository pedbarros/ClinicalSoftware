<?php

namespace App\Http\Controllers\API;

use App\Models\Especialidade;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EspecialidadeController extends Controller
{
    // SELECT * FROM ALL
    public function index()
    {
        return response()->json(Especialidade::all(), 201);
    }

    // INSERT
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Os campos não foram validados'], 401);
        }

        $especialidade = Especialidade::create($request->all());

        return response()->json($especialidade, 201);
    }

    // SELECT * FROM ALL WHERE ID = :PARAMS
    public function show($id)
    {
        // dd("Pedron");
        return response()->json(Especialidade::find($id), 201);
    }

    // UPDATE
    public function update(Request $request, Especialidade $especialidade)
    {
        //dd($especialidade);
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Os campos não foram validados'], 401);
        }

        $especialidade->update($request->all());

        return response()->json($especialidade, 200);
    }

    // DELETE
    public function destroy(Especialidade $especialidade)
    {
        try {

            $especialidade->delete();

            // return response()->json(null, 204);
            return response()->json(['destroy' => true, 'msg' => 'Especialidade inserida com sucesso'], 204);
        } catch (\Exception $e) {
            // dd($e->errorInfo[1]);
            $codigo_erro = $e->errorInfo[1];

            if ($codigo_erro == 1451)
                $msg = "Não é possível deletar, pois essa especialidade já está sendo utilizada em outros serviços do sistema.";
            else
                $msg = "Erro ao cadastrar a especialidade!";
            return response()->json(['destroy' => false, 'msg' => $msg], 500);
        }
    }
}
