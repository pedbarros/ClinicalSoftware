<?php

use Illuminate\Http\Request;



$this->group(['namespace' => 'API'], function () {
    $this->resource('profissao', 'ProfissaoController');
});

Route::post('/auth/login', function (Request $request) {
    if (Auth::attempt(['usuario' => $request->get('usuario'), 'password' =>  $request->get('password') ], false)) {
        return response()->json(['retorno' => Auth::user()]);
    } else {
        return response()->json(['retorno' => 'Dados inválidos']);
    }
});

