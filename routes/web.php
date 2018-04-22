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
    });
});

Auth::routes();

// ROTAS DE LOGIN
$this->post('/login', function (\Illuminate\Http\Request $request, \Tymon\JWTAuth\JWTAuth $jwtAuth) {
    // dd($request->all());
    try {
        if (Auth::attempt(['usuario' => $request->get('usuario'), 'password' => $request->get('password')], false)) {
            $user = Auth::user();
            $token = $jwtAuth->fromUser($user);
            session(['token' => $token]);
            // dd($token);
            return redirect()->route('home');
        } else {
            return "Incorreta parceiro!";
        }
    } catch (JWTException $e) {
        return response()->json(['access' => false, 'error' => 'Não foi possível criar token'], 500);
    }
})->name('login');


// ROTAS DE LOGIN
$this->post('/login2', function (\Illuminate\Http\Request $request) {
    // dd($request->all());
    if (Auth::attempt(['usuario' => $request->get('usuario'), 'password' => $request->get('password')], false)) {
        return redirect()->route('home');
    } else {
        return "Incorreta parceiro!";
    }
})->name('login2');













/* $this->any('search/', 'PacienteController@search')->name("paciente.search");

       $this->get('{paciente}/registros', 'RegistroClinicoController@index')->name("paciente.registros");

       //VISUALIZAR REGISTROS CLINICOS
       $this->get('{paciente}/registros/{rcl_cod}/{rcl_dthr}', 'RegistroClinicoController@show')->name("registro.show");


       //NOVO REGISTRO CLINICO
       $this->get('{paciente}/qst-sos', 'QuestionarioController@index')->name("paciente.qst-sos");*/