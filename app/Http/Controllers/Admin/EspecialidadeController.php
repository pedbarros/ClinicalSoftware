<?php

namespace App\Http\Controllers\Admin;

use App\Models\Especialidade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class EspecialidadeController extends Controller
{
    private $especialidade;

    public function __construct(Especialidade $especialidade)
    {
        $this->especialidade = $especialidade;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = Request::create('/api/especialidade', 'GET');
        $especialidades = Route::dispatch($request)->getData();
     //   dd($especialidades);
        return view('admin.especialidade.index', compact('especialidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request = Request::create('/api/especialidade', 'POST', $request->all());
        $especialidade = Route::dispatch($request)->getData();
        //dd($especialidade->getData());
        if ($especialidade) {
            return redirect()
                ->route('especialidade.index')
                ->with('success', 'Especialidade inserida com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao inserir');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "Entrou no show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $especialidade = $this->especialidade->find($id);
        return view('admin.especialidade.edit', compact('especialidade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request = Request::create('/api/especialidade/'.$id, 'PUT', $request->all());
        $especialidade = Route::dispatch($request)->getData();

        if ($especialidade) {
            return redirect()
                ->route('especialidade.index')
                ->with('success', 'Especialidade atualizada com sucesso!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao atualizar');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd("easdsa");
    }
}
