<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    protected $fillable = [
        'nome_plano', 'status'
    ];

    public $timestamps = false;

    public function profissionais()
    {
        return $this->belongsToMany('App\Models\Profissional', 'plano_profissionais', 'plano_id',
            'profissional_id')->withPivot('status');
    }

}
