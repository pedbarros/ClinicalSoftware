<?php

namespace App\Http\Controllers\API;

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
        return response()->json(Agenda::with('paciente', 'paciente.pessoas', 'profissional', 'profissional.pessoas', 'profissional.especialidades')->get(), 201);
    }

    // SELECT * FROM ALL WHERE ID = :PARAMS
    public function show($id)
    {
        return response()->json(Agenda::with('paciente', 'profissional')->find($id), 201);
    }

    public function searchAgenda(Request $request)
    {
        // dd($request->all());
        $agenda = Agenda::with('paciente', 'paciente.pessoas', 'profissional', 'profissional.pessoas', 'profissional.especialidades');

        $agenda->where(function($query) use ($request) {
            if (isset($request['data_agendamento']))
                $query->where('data_agendamento', $request['data_agendamento']);
            if (isset($request['profissional_id']))
                $query->where('profissional_id', $request['profissional_id']);
            if (isset($request['paciente_id']))
                $query->where('paciente_id', $request['paciente_id']);
        });
       // dd($agenda->toSql());
        return response()->json($agenda->get(), 201);
    }


    public function quantidadeAgendamentosEmDeterminadoMes($anomes)
    {
        //  '201804'
        /*$qtd = DB::select("SELECT status_agendamento, sigla_status, COUNT(status_agendamento) qtd
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
                                  GROUP BY status_agendamento, sigla_status");*/

        $qtd = DB::table('agendas')
                ->select(DB::raw("count(*) as qtd, (CASE status_agendamento 
                                                WHEN 'C' THEN 'Atendidos' WHEN 'F' THEN 'Faltou' 
                                                WHEN 'E' THEN 'Em espera' ELSE 'Sem status' END ) as status_agendamento, status_agendamento AS sigla_status"))
                ->groupBy('status_agendamento', 'sigla_status')
                ->where(DB::raw("DATE_FORMAT(data_agendamento, '%Y%m')"), '=', $anomes)
                ->get();

        // dd($qtd->toSql());
        return response()->json($qtd, 201);
    }

    // INSERT
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "data_agendamento"=> 'required|string',
            "horario_inicial"=> 'required|string',
            "horario_final"=> 'required|string',
            "obs"=> 'required|string|max:100',
            "status_agendamento" => 'required|string|max:1',
            "profissional_id" => 'required|integer|max:11',
            "paciente_id"=> 'required|integer|max:11',
        ]);
        // dd($validator->errors());

        if ($validator->fails()) {
            return response()->json(['error' => 'Os campos não foram validados'], 401);
        }

        $agenda = Agenda::create($request->all());

        return response()->json($agenda, 201);

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
