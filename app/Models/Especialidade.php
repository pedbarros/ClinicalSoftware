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
        return $this->belongsToMany('App\Models\Profissao', 'especialidade_profissoes', 'especialidade_id',
            'profissao_id')->withPivot('status');
    }

    public function profissional()
    {
        return $this->hasMany('App\Models\Profissional', 'profissional_id');
    }

}
