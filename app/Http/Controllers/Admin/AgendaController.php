<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agenda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;

class AgendaController extends Controller
{
    private $agenda;

    public function __construct(Agenda $agenda)
    {
        $this->agenda = $agenda;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Input::merge(["data_agendamento" => date('Y-m-d')]);
        $request = Request::create('/api/search-agenda', 'POST');
        $agendas = json_decode(Route::dispatch($request)->getContent());

        $request = Request::create('/api/profissional', 'GET');
        $profissionais = json_decode(Route::dispatch($request)->getContent());
        // dd($profissionais);

        $request = Request::create('/api/paciente', 'GET');
        $pacientes = json_decode(Route::dispatch($request)->getContent());

        return view('admin.agenda.index', compact('profissionais', 'pacientes', 'agendas'));
    }


    public function create()
    {
        $request = Request::create('/api/profissional', 'GET');
        $profissionais = json_decode(Route::dispatch($request)->getContent());
        // dd($profissionais);

        $request = Request::create('/api/paciente', 'GET');
        $pacientes = json_decode(Route::dispatch($request)->getContent());

        return view('admin.agenda.create', compact('profissionais', 'pacientes'));
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $request = Request::create('/api/agenda', 'POST', $request->all());
        $agenda = json_decode(Route::dispatch($request)->getContent());
// dd($agenda);
        if ($agenda) {
            return redirect()
                ->route('agenda.index')
                ->with('success', 'Agenda inserido com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao inserir o Agenda');
        }

    }

    public function edit($id)
    {
        // dd($id);
        $request = Request::create('/api/agenda/' . $id, 'GET');
        $agenda = json_decode(Route::dispatch($request)->getContent());

        $request = Request::create('/api/paciente', 'GET');
        $pacientes = json_decode(Route::dispatch($request)->getContent());

        $request = Request::create('/api/profissional', 'GET');
        $profissionais = json_decode(Route::dispatch($request)->getContent());
        // dd($profissionais );

        return view('admin.agenda.edit', compact('agenda', 'profissionais', 'pacientes'));
    }

    public function update(Request $request, $id)
    {
        $request = Request::create('/api/agenda/' . $id, 'PUT', $request->all());
        $agenda = json_decode(Route::dispatch($request)->getContent());
        if ($agenda) {
            return redirect()
                ->route('agenda.index')
                ->with('success', 'Agenda atualizado com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao atualizar o Agenda');
        }
    }

    public function destroy($id)
    {
        $request = Request::create('/api/agenda/' . $id, 'DELETE');
        $statusCode = json_decode(Route::dispatch($request)->getStatusCode());
        // dd($statusCode);
        if ($statusCode == 204) { // No Content
            return redirect()
                ->route('agenda.index')
                ->with('success', 'Agenda apagado com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao apagar o agenda');
        }
    }



    public function searchAgenda(Request $request)
    {

        $dataForm = array_filter($request->except('_token'));

        $request = Request::create('/api/profissional', 'GET');
        $profissionais = json_decode(Route::dispatch($request)->getContent());
        // dd($profissionais);

        $request = Request::create('/api/paciente', 'GET');
        $pacientes = json_decode(Route::dispatch($request)->getContent());

        Input::replace($dataForm);
        $request1 = Request::create('/api/search-agenda', 'POST');
        $agendas = json_decode(Route::dispatch($request1)->getContent());
       // dd($agendas);

        return view('admin.agenda.index', compact('profissionais', 'pacientes', 'agendas'));
    }
}
