<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profissao extends Model
{
    protected $table = 'profissoes';

    protected $fillable = [
        'descricao'
    ];

    public $timestamps = false;


    public function especialidades()
    {
        return $this->belongsToMany('App\Models\Especialidade', 'especialidade_profissoes', 'profissao_id',
            'especialidade_id')->withPivot('status');
    }
}
