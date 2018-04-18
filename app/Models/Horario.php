<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    public $timestamps = false;

    protected $fillable = ['dia_semana', 'horario_inicio', 'horario_final', 'quantidade_consultas', 'profissional_id'];

    public function profissionais()
    {
        return $this->belongsTo('App\Models\Profissional', 'profissional_id');
    }
}
