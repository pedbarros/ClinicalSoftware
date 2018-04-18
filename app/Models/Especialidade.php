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

    public function profissoes()
    {
        return $this->belongsToMany('App\Models\Profissao', 'especialidade_profissoes', 'profissao_id',
            'especialidade_id')->withPivot('status');
    }

}
