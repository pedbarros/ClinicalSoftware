<?php


Route::post('/auth/register', 'API\RegisterController@register');
Route::post('auth/login', 'API\LoginController@login');
Route::post('auth/refresh', 'API\LoginController@refresh');
Route::get('auth/logout', 'API\LoginController@logout');
Route::get('list-users', 'API\LoginController@list_users');


Route::group([/*'middleware' => 'jwt.auth', */'namespace' => 'API'], function () {

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
    //dia_semana
    $this->any('horario/{prof}', 'HorarioController@obterHorarioMedico');
    $this->resource('horario', 'HorarioController');
    $this->resource('profissional', 'ProfissionalController');
    $this->resource('paciente', 'PacienteController');
    $this->resource('agenda', 'AgendaController');
    $this->resource('pessoa', 'PessoaController');
    $this->resource('nivel-acesso', 'NivelAcessoController');



});