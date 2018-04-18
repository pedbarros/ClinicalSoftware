<?php

namespace App\Http\Controllers\Admin;

use App\Models\Horario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class HorarioController extends Controller
{
    private $horario;

    public function __construct(Horario $horario)
    {
        $this->horario = $horario;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = Request::create('/api/horario', 'GET');
        $horarios = json_decode(Route::dispatch($request)->getContent());
        // dd($horarios);
        return view('admin.horario-profissional.index', compact('horarios'));
    }


    public function store(Request $request)
    {
        //dd($request->all());
        $request = Request::create('/api/horario', 'POST', $request->all());
        $horario = json_decode(Route::dispatch($request)->getContent());

        if ($horario) {
            return redirect()
                ->route('horario-profissional.index')
                ->with('success', 'Horário inserido com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao inserir o horário');
        }

    }

        public function edit($id)
        {
            $horarios = $this->horario->all();
            $horario = $this->horario->find($id);
            return view('admin.horario-profissional.edit', compact('horario', 'horarios'));
        }

        public function update(Request $request, $id)
        {
            $request = Request::create('/api/horario/'.$id, 'PUT', $request->all());
            $horario = json_decode(Route::dispatch($request)->getContent());
            if ($horario) {
                return redirect()
                    ->route('horario-profissional.index')
                    ->with('success', 'Horario atualizado com sucesso!');
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao atualizar o horario');
            }
        }

        public function destroy($id)
        {
            $request = Request::create('/api/horario/'.$id, 'DELETE');
            $statusCode = json_decode(Route::dispatch($request)->getStatusCode());
            // dd($statusCode);
            if ($statusCode == 204) { // No Content
                return redirect()
                    ->route('horario-profissional.index')
                    ->with('success', 'Horario apagado com sucesso!');
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao apagar o horario');
            }
        }
}
