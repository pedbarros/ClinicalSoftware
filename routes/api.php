<?php


Route::post('/auth/register', 'API\RegisterController@register');
Route::post('auth/login', 'API\AuthController@login');
Route::post('auth/refresh', 'API\AuthController@refresh');
Route::get('auth/logout', 'API\AuthController@logout');


Route::group([/*'middleware' => 'jwt.auth',*/ 'namespace' => 'API'], function () {

    // ESPECIALIDADE/PROFISSÃO
    $this->get('especialidade/profissao/', 'EspecialidadeProfissoesController@index');  // especialidade/#/profissao/#
    $this->get('especialidade/{especialidade_id}/profissao/{profissao_id}', 'EspecialidadeProfissoesController@show');  // especialidade/#/profissao/#
    $this->post('especialidade/{especialidade_id}/profissao/{profissao_id}', 'EspecialidadeProfissoesController@store');  // especialidade/#/profissao/#
    $this->delete('especialidade/{especialidade_id}/profissao/{profissao_id}', 'EspecialidadeProfissoesController@destroy');  // especialidade/#/profissao/#

    $this->resource('profissao', 'ProfissaoController');
    $this->resource('especialidade', 'EspecialidadeController');
    $this->resource('plano', 'PlanoController');
    $this->resource('horario', 'HorarioController');
    $this->resource('profissional', 'ProfissionalController');



});