<?php


// ROTAS QUE NECESSITAM DE AUTENTICAÇÃO
$this->group(['middleware' => 'auth'], function () {
    //
    $this->group(['namespace' => 'Admin'], function () {
        $this->get('/', 'HomeController@index')->name('home');
        $this->resource('profissao', 'ProfissaoController');
        $this->resource('especialidade', 'EspecialidadeController');
        $this->resource('especialidade-profissao', 'EspecialidadeProfissoesController');
        $this->resource('plano', 'PlanoController');
        $this->resource('horario-profissional', 'HorarioController');
        $this->resource('profissional', 'ProfissionalController');
        $this->resource('plano-profissional', 'PlanoProfissionalController');
        $this->resource('paciente', 'PacienteController');
        $this->resource('agenda', 'AgendaController');
        $this->resource('login-pessoa', 'LoginController');
    });
});

Auth::routes();

// ROTAS DE LOGIN
$this->post('/login', 'Admin\LoginController@auth')->name('login');


/*
  // ENVIANDO DADOS SEM UTILIZAR O REQUEST ($request->all())
    Input::merge(["dia_semana" => "2", "desc" => "Pedroviks"]);
        $request = Request::create('/api/agenda-dia', 'POST');
        $response = Route::dispatch($request);

        dd($response);

 */