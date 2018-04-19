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

    // PLANO/PROFISSIONAL
    $this->get('plano/profissional/', 'PlanoProfissionalController@index');  // plano/#/profissional/#
    $this->get('plano/{plano_id}/profissional/{profissional_id}', 'PlanoProfissionalController@show');  // plano/#/profissional/#
    $this->post('plano/{plano_id}/profissional/{profissional_id}', 'PlanoProfissionalController@store');  // plano/#/profissional/#
    $this->delete('plano/{plano_id}/profissional/{profissional_id}', 'PlanoProfissionalController@destroy');  // plano/#/profissional/#


    $this->resource('profissao', 'ProfissaoController');
    $this->resource('especialidade', 'EspecialidadeController');
    $this->resource('plano', 'PlanoController');
    $this->resource('horario', 'HorarioController');
    $this->resource('profissional', 'ProfissionalController');
    $this->resource('paciente', 'PacienteController');
    $this->resource('agenda', 'AgendaController');



});