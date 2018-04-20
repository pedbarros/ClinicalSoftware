<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{

    protected $fillable = [
        'nome', 'sexo',
        'data_nascimento', 'telefone',
        'cpf'
    ];

    public $timestamps = false;

    /*public function getDataNascimentoAttribute($date)
    {
        return $date->toFormattedDateString();
    }*/

    public function user()
    {
        return $this->hasMany('App\User', 'pessoa_id');
    }

    public function profissional()
    {
        return $this->hasMany('App\Models\Profissional');
    }

    public function paciente()
    {
        return $this->hasMany('App\Models\Paciente');
    }
}
