<?php

namespace App\Http\Controllers\Admin;

use App\Models\Profissional;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class ProfissionalController extends Controller
{
    private $profissional;

    public function __construct(Profissional $profissional)
    {
        $this->profissional = $profissional;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = Request::create('/api/profissional', 'GET');
        $profissionais = json_decode(Route::dispatch($request)->getContent());
        // dd($profissionais);

        $request = Request::create('/api/especialidade', 'GET');
        $especialidades = json_decode(Route::dispatch($request)->getContent());
        /// dd($especialidades);
        return view('admin.profissional.index', compact('profissionais', 'especialidades'));
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $request = Request::create('/api/profissional', 'POST', $request->all());
        $profissional = json_decode(Route::dispatch($request)->getContent());
//dd($profissional);
        if ($profissional) {
            return redirect()
                ->route('profissional.index')
                ->with('success', 'Profissional inserido com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao inserir o profissional');
        }

    }

    public function edit($id)
    {
        $profissionais = $this->profissional->all();
        $profissional = $this->profissional->find($id);
        $request = Request::create('/api/especialidade', 'GET');
        $especialidades = json_decode(Route::dispatch($request)->getContent());

        return view('admin.profissional.edit', compact('profissional', 'profissionais', 'especialidades'));
    }

    public function update(Request $request, $id)
    {
        $request = Request::create('/api/profissional/' . $id, 'PUT', $request->all());
        $profissional = json_decode(Route::dispatch($request)->getContent());
        if ($profissional) {
            return redirect()
                ->route('profissional.index')
                ->with('success', 'Profissional atualizado com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao atualizar o Profissional');
        }
    }

    public function destroy($id)
    {
        $request = Request::create('/api/profissional/' . $id, 'DELETE');
        $statusCode = json_decode(Route::dispatch($request)->getStatusCode());
        // dd($statusCode);
        if ($statusCode == 204) { // No Content
            return redirect()
                ->route('profissional.index')
                ->with('success', 'Profissional apagado com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao apagar o Profissional');
        }
    }
}