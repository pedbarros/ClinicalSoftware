<?php



// ROTAS QUE NECESSITAM DE AUTENTICAÇÃO
$this->group(['middleware' => ['auth']], function () {
    //
    $this->group(['namespace' => 'Admin'], function () {
        $this->get('/', 'HomeController@index')->name('home');
        $this->resource('profissao', 'ProfissaoController');
        $this->resource('especialidade', 'EspecialidadeController');
    });
});

Auth::routes();

// ROTAS DE LOGIN
$this->post('/login', function (\Illuminate\Http\Request $request) {
   // dd($request->all());
    if (Auth::attempt(['usuario' => $request->get('usuario'), 'password' =>  $request->get('password') ], false)) {
        return redirect()->route('home');
    } else {
        return "Incorreta parceiro!";
    }
})->name('login');
















/* $this->any('search/', 'PacienteController@search')->name("paciente.search");

       $this->get('{paciente}/registros', 'RegistroClinicoController@index')->name("paciente.registros");

       //VISUALIZAR REGISTROS CLINICOS
       $this->get('{paciente}/registros/{rcl_cod}/{rcl_dthr}', 'RegistroClinicoController@show')->name("registro.show");


       //NOVO REGISTRO CLINICO
       $this->get('{paciente}/qst-sos', 'QuestionarioController@index')->name("paciente.qst-sos");*/