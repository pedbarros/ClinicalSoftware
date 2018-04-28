<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Search\AgendaSearch;
use App\Models\Agenda;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgendaController extends Controller
{
    // SELECT * FROM ALL
    public function index()
    {
        //return response()->json(Agenda::all(), 201);
        return response()->json(Agenda::getAllRelations()->get(), 201);
    }

    // SELECT * FROM ALL WHERE ID = :PARAMS
    public function show($id)
    {
        return response()->json(Agenda::getAllRelations()->find($id), 201);
    }

    public function searchAgenda(Request $request)
    {
        return response()->json(AgendaSearch::apply($request), 201);
    }


    public function quantidadeAgendamentosEmDeterminadoMes($anomes)
    {
        //  '201804'
        // " .$request['MESANO'] ."
        $qtd = DB::select("SELECT status_agendamento, sigla_status, COUNT(status_agendamento) qtd
                                  FROM
                                    (   SELECT
                                            (   CASE a.status_agendamento
                                                WHEN 'C' THEN 'Atendidos'
                                                WHEN 'F' THEN 'Faltou'
                                                WHEN 'E' THEN 'Em espera'
                                                ELSE 'Sem status' END ) AS status_agendamento,
                                            a.status_agendamento AS sigla_status
                                        FROM agendas a WHERE DATE_FORMAT(a.data_agendamento, '%Y%m') = " . $anomes ."
                                    ) AS A
                                  GROUP BY status_agendamento, sigla_status");

        //dd($qtd);
        return response()->json($qtd, 201);
    }

    // INSERT
    public function store(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                "profissional_id" => 'required|integer|max:11',
                "data_agendamento"=> 'required|string',
                "horario_inicial"=> 'required|string',
                "horario_final"=> 'required|string',

                "obs"=> 'required|string|max:100',
                "status_agendamento" => 'required|string|max:1',
                "paciente_id"=> 'required|integer|max:11',

                'data_agendamento'=>'unique:agendas,data_agendamento,NULL,id,profissional_id,' . $request->get('id'),
            ]);
            //dd($validator->errors());

            if ($validator->fails()) {
                return response()->json(['error' => 'Os campos não foram validados'], 401);
            }

            $agenda = Agenda::create($request->all());

            return response()->json(['store' => true, 'msg' => $agenda], 201);
        } catch (\Exception $e) {
            // dd($e->errorInfo[1]);
            $codigo_erro = $e->errorInfo[1];

            if ($codigo_erro == 1062)
                $msg = "Já existe agendamento no horário especificado para esse profissional!";
            else
                $msg = "Erro ao cadastrar o profissional ao plano!";
            return response()->json(['store' => false, 'msg' => $msg], 500);
        }


        /*$validator = Validator::make($request->all(), [
            "profissional_id" => 'required|integer|max:11',
            "data_agendamento"=> 'required|string',
            "horario_inicial"=> 'required|string',
            "horario_final"=> 'required|string',

            "obs"=> 'required|string|max:100',
            "status_agendamento" => 'required|string|max:1',
            "paciente_id"=> 'required|integer|max:11',

            'data_agendamento'=>'unique:agendas,data_agendamento,NULL,id,profissional_id,' . $request->get('id'),
        ]);
        //dd($validator->errors());

        if ($validator->fails()) {
            return response()->json(['error' => 'Os campos não foram validados'], 401);
        }

        $agenda = Agenda::create($request->all());

       // dd($agenda);

        return response()->json($agenda, 201);*/

    }



    // UPDATE
    public function update(Request $request, Agenda $agenda)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            // 'cod_conselho' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Os campos não foram validados'], 401);
        }

        $agenda->update($request->all());

        return response()->json($agenda, 200);
    }

    // DELETE
    public function destroy(Agenda $agenda)
    {
        try{
            $agenda->delete();

            return response()->json(null, 204);
        }catch (\Exception $e){
            // dd($e);
            return response()->json(['destroy' => false, 'msg' => 'Não foi possível apagar esse Agenda'], 500);
        }

    }
}
