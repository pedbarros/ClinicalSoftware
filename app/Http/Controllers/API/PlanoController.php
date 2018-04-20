<?php

namespace App\Http\Controllers\API;

use App\Models\Plano;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanoController extends Controller
{
    // SELECT * FROM ALL
    public function index()
    {
        return response()->json(Plano::all(), 201);
    }

    // INSERT
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome_plano' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Os campos não foram validados'], 401);
        }

        $plano = Plano::create($request->all());

        return response()->json($plano, 201);
    }

    // SELECT * FROM ALL WHERE ID = :PARAMS
    public function show($id)
    {
        return response()->json(Plano::find($id), 201);
    }

    // UPDATE
    public function update(Request $request, Plano $plano)
    {
        //dd($plano);
        $validator = Validator::make($request->all(), [
            'nome_plano' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Os campos não foram validados'], 401);
        }

        $plano->update($request->all());

        return response()->json($plano, 200);
    }

    // DELETE
    public function destroy(Plano $plano)
    {
        $plano->delete();

        return response()->json(null, 204);
    }
}
