<?php


Route::post('/auth/register', 'API\RegisterController@register');
Route::post('auth/login', 'API\AuthController@login');
Route::post('auth/refresh', 'API\AuthController@refresh');
Route::get('auth/logout', 'API\AuthController@logout');


Route::group([/*'middleware' => 'jwt.auth',*/ 'namespace' => 'API'], function () {
    $this->resource('profissao', 'ProfissaoController');
    $this->resource('especialidade', 'EspecialidadeController');
});