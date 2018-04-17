<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Models\Profissao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfissaoController extends Controller
{
    private $profissao;

    public function __construct(Profissao $profissao)
    {
        $this->profissao = $profissao;
    }

    // SELECT * FROM ALL
    public function index()
    {
        return response()->json($this->profissao->all(), 201);
    }

    // INSERT
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'descricao' => 'required|string|max:255',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Os campos não foram validados'], 401);
        }

        $profissao = $this->profissao->create($request->all());

        return response()->json($profissao, 201);
    }
/*
    // SELECT * FROM ALL WHERE ID = :PARAMS
    public function show($id)
    {
        return new ProductResource(Product::find($id));
    }



    // UPDATE
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'price' => 'integer',
            'category_id' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Os campos não foram validados'], 401);
        }

        $product->update($request->all());

        return response()->json($product, 200);
    }

    // DELETE
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(null, 204);
    }*/
}
