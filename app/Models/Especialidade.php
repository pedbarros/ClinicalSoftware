<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
   // protected $table = 'profissoes';

    protected $fillable = [
        'nome', 'descricao'
    ];

    public $timestamps = false;

}