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

    public function getHorarioInicialAttribute( $horario )
    {
        if ( $horario === null ){
            return "";
        }
        return $horario;
    }

    public function getHorarioFinalAttribute( $horario )
    {
        if ( $horario === null ){
            return "";
        }
        return $horario;
    }


}
