<?php


Route::post('/auth/register', 'API\RegisterController@register');
Route::post('auth/login', 'API\AuthController@login');
Route::post('auth/refresh', 'API\AuthController@refresh');
Route::get('auth/logout', 'API\AuthController@logout');


Route::group(['middleware' => 'jwt.auth', 'namespace' => 'API'], function () {
    $this->resource('profissao', 'ProfissaoController');
});
/*
if (Auth::attempt(['usuario' => $request->get('usuario'), 'password' =>  $request->get('password') ], false)) {
    return response()->json(['retorno' => Auth::user()]);
} else {
    return response()->json(['retorno' => 'Dados inválidos']);
}*/