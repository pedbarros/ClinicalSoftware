<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    // protected $table = 'paciente';

    protected $fillable = [
        'data_agendamento', 'horario_inicial',
        'horario_final', 'obs',
        'status_agendamento',
        'profissional_id', 'paciente_id',
    ];

    public $timestamps = false;

    public function paciente()
    {
        return $this->belongsTo('App\Models\Paciente', 'paciente_id');
    }

    public function profissional()
    {
        return $this->belongsTo('App\Models\Profissional', 'profissional_id');
    }


    public function status_agendamento($status = null)
    {
        $opStatus = [
            'C' => 'Concluído',
            'E'      => 'Em espera',
            'F'    => 'Faltou',
            'X'    => 'Cancelado',
        ];

        if (!$status)
            return $opStatus;

        return $opStatus[$status];
    }

    public static function getAllRelations(){
        return Agenda::with('paciente', 'paciente.pessoas', 'profissional', 'profissional.pessoas', 'profissional.especialidades');
    }

   /* public function teste()
    {
        return $this->hasManyThrough(
            'App\Owner', 'App\Network',
            'location_id', 'network_id', 'id'
        );
    }*/
}
