<?php

namespace App\Http\Controllers\Admin;

use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class PacienteController extends Controller
{
    private $sexos = ["M" => "Masculino", "F" => "Feminino"];

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = Request::create('/api/paciente', 'GET');
        $pacientes = json_decode(Route::dispatch($request)->getContent());
        // dd($profissionais);

        $request = Request::create('/api/plano', 'GET');
        $planos = json_decode(Route::dispatch($request)->getContent());

        /// dd($especialidades);
        $sexos = $this->sexos;
        return view('admin.paciente.index', compact('pacientes', 'planos', 'sexos'));
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $request = Request::create('/api/paciente', 'POST', $request->all());
        $paciente = json_decode(Route::dispatch($request)->getContent());
        //  dd($paciente);
        if ($paciente) {
            return redirect()
                ->route('paciente.index')
                ->with('success', 'Paciente inserido com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao inserir o paciente');
        }

    }

    public function edit($id)
    {
        $request = Request::create('/api/paciente', 'GET');
        $pacientes = json_decode(Route::dispatch($request)->getContent());

        $request = Request::create('/api/paciente/' . $id, 'GET');
        $paciente = json_decode(Route::dispatch($request)->getContent());

        $request = Request::create('/api/plano', 'GET');
        $planos = json_decode(Route::dispatch($request)->getContent());
        $sexos = $this->sexos;

        return view('admin.paciente.edit', compact('paciente', 'pacientes', 'planos', 'sexos'));
    }

    public function update(Request $request, $id)
    {
        $request = Request::create('/api/paciente/' . $id, 'PUT', $request->all());
        $paciente = json_decode(Route::dispatch($request)->getContent());
        if ($paciente) {
            return redirect()
                    ->route('paciente.index')
                    ->with('success', 'Paciente atualizado com sucesso!');
        } else {
            return redirect()
                    ->back()
                    ->with('error', 'Falha ao atualizar o Paciente');
        }
    }

    public function destroy($id)
    {
        $request = Request::create('/api/paciente/' . $id, 'DELETE');
        $statusCode = json_decode(Route::dispatch($request)->getStatusCode());
        // dd($statusCode);
        if ($statusCode == 204) { // No Content
            return redirect()
                ->route('paciente.index')
                ->with('success', 'Paciente apagado com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao apagar o Paciente');
        }
    }
}
