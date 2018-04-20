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


    public function profissional()
    {
        return $this->hasMany('App\Models\Profissional', 'profissional_id');
    }
}
