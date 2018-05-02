<?php

namespace App\Http\Controllers\Admin;

use App\Models\Profissional;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class ProfissionalController extends Controller
{
    private $sexos = ["M" => "Masculino", "F" => "Feminino"];

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

        $sexos = $this->sexos;
        return view('admin.profissional.index', compact('profissionais', 'especialidades', 'sexos'));
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
        $request = Request::create('/api/profissional', 'GET');
        $profissionais = json_decode(Route::dispatch($request)->getContent());

        $request = Request::create('/api/profissional/' . $id, 'PUT', $request->all());
        $profissional = json_decode(Route::dispatch($request)->getContent());

        $request = Request::create('/api/especialidade', 'GET');
        $especialidades = json_decode(Route::dispatch($request)->getContent());
        $sexos = $this->sexos;
        return view('admin.profissional.edit', compact('profissional', 'profissionais', 'especialidades', 'sexos'));
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
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
        $statusCode = Route::dispatch($request)->getData();
        // dd($statusCode->destroy);
        if ($statusCode->destroy == true) { // No Content
            return redirect()
                ->route('profissional.index')
                ->with('success', 'Profissional apagado com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', $statusCode->msg);
        }

    }
}
