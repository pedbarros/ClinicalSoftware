<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profissional extends Model
{
    protected $table = 'profissionais';

    protected $fillable = [
        'cod_conselho', 'data_entrada',
        'data_saida', 'pessoa_id',
        'especialidade_id'
    ];

    public $timestamps = false;

    public function pessoas()
    {
         return $this->belongsToMany('App\Models\Pessoa', 'pessoa_id');
        // return $this->hasMany('App\Models\Pessoa', 'pessoa_id');
    }

    public function especialidades()
    {
        return $this->belongsTo('App\Models\Especialidade', 'especialidade_id');
    }

    public function planos()
    {
        return $this->belongsToMany('App\Models\Plano', 'plano_profissionais', 'profissional_id',
            'plano_id')->withPivot('status');
    }

}
