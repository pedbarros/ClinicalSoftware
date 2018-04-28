<?php

namespace App\Http\Controllers\Search;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaSearch
{
    public static function apply(Request $filters)
    {
        $agenda = Agenda::getAllRelations();

        if ($filters->has('data_agendamento')) {
            $agenda->where('data_agendamento', $filters->input('data_agendamento'));
        }

        if ($filters->has('profissional_id')) {
            $agenda->where('profissional_id', $filters->input('profissional_id'));
        }

        if ($filters->has('paciente_id')) {
            $agenda->where('paciente_id', $filters->input('paciente_id'));
        }

        // Only return users who are assigned
        // to the given sales manager(s).
        /*if ($filters->has('managers')) {
            $agenda->whereHas('managers',
                function ($query) use ($filters) {
                    $query->whereIn('managers.name',
                        $filters->input('managers'));
                });
        }*/

        return $agenda->get();
    }
}