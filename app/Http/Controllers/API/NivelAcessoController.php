<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Models\NivelAcesso;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NivelAcessoController extends Controller
{
    // SELECT * FROM ALL
    public function index()
    {
        return response()->json(NivelAcesso::all(), 201);
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

        $nivelAcesso = NivelAcesso::create($request->all());

        return response()->json($nivelAcesso, 201);
    }

    // SELECT * FROM ALL WHERE ID = :PARAMS
    public function show($id)
    {
        return response()->json(NivelAcesso::find($id), 201);
    }



    // UPDATE
    public function update(Request $request, NivelAcesso $nivelAcesso)
    {
        $validator = Validator::make($request->all(), [
            'descricao' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Os campos não foram validados'], 401);
        }

        $nivelAcesso->update( $request->all() );

        return response()->json($nivelAcesso, 200);
    }

    // DELETE
    public function destroy(NivelAcesso $nivelAcesso)
    {
        $nivelAcesso->delete();

        return response()->json(null, 204);
    }
}
