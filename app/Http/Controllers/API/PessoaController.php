<?php

namespace App\Http\Controllers\API;

use App\Models\Pessoa;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PessoaController extends Controller
{
    // SELECT * FROM ALL
    public function index()
    {
        return response()->json(Pessoa::all(), 201);
    }

    // SELECT * FROM ALL WHERE ID = :PARAMS
    public function show($id)
    {
        return response()->json(Pessoa::find($id), 201);
    }

    // INSERT
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
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

        return response()->json($pessoa, 201);

    }



    // UPDATE
    public function update(Request $request, Pessoa $pessoa)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            // 'cod_conselho' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Os campos não foram validados'], 401);
        }

        $pessoa->update($request->all());

        return response()->json($pessoa, 200);
    }

    // DELETE
    public function destroy(Pessoa $pessoa)
    {
        try {

            $pessoa->delete();

            return response()->json(['destroy' => true, 'msg' => 'Pessoa inserido com sucesso'], 204);
        } catch (\Exception $e) {
            // dd($e->errorInfo[1]);
            $codigo_erro = $e->errorInfo[1];

            if ($codigo_erro == 1451)
                $msg = "Não é possível deletar, pois esse pessoa já está sendo utilizado em outros serviços do sistema.";
            else
                $msg = "Erro ao cadastrar o pessoa!";
            return response()->json(['destroy' => false, 'msg' => $msg], 500);
        }

    }
}
