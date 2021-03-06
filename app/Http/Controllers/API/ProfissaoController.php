<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Models\Profissao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfissaoController extends Controller
{
    // SELECT * FROM ALL
    public function index()
    {
        $profissao = Profissao::all(); //paginate(5);
        return response()->json($profissao, 201);
    }

    // INSERT
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'descricao' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Os campos não foram validados'], 401);
        }

        $profissao = Profissao::create($request->all());

        return response()->json($profissao, 201);
    }

    // SELECT * FROM ALL WHERE ID = :PARAMS
    public function show($id)
    {
        return response()->json(Profissao::find($id), 201);
    }



    // UPDATE
    public function update(Request $request, Profissao $profissao)
    {
        $validator = Validator::make($request->all(), [
            'descricao' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Os campos não foram validados'], 401);
        }

        $profissao->update( $request->all() );

        return response()->json($profissao, 200);
    }

    // DELETE
    public function destroy(Profissao $profissao)
    {
        $profissao->delete();

        return response()->json(null, 204);
    }
}
