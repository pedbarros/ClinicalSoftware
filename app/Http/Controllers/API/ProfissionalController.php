<?php

namespace App\Http\Controllers\API;

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
        return response()->json(Profissional::with('pessoas', 'especialidades')->get(), 201);
    }

    // SELECT * FROM ALL WHERE ID = :PARAMS
    public function show($id)
    {
        return response()->json(Profissional::find($id), 201);
    }

    // INSERT
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cod_conselho' => 'required|string|max:15',
            'data_entrada' => 'required',
            'pessoa_id' => 'required|integer|max:11',
            'especialidade_id' => 'required|integer|max:11',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Os campos não foram validados'], 401);
        }

        $profissonal = Profissional::create($request->all());

        return response()->json($profissonal, 201);
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

        $profissional->update( $request->all() );

        return response()->json($profissional, 200);
    }

    // DELETE
    public function destroy(Profissional $profissional)
    {
        $profissional->delete();

        return response()->json(null, 204);
    }
}
