<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    // protected $table = 'paciente';

    protected $fillable = [
        'data_entrada',
        'pessoa_id',
        'plano_id'
    ];

    public $timestamps = false;

    public function pessoa()
    {
        return $this->belongsTo('App\Models\Pessoa', 'pessoa_id');
        // return $this->hasMany('App\Models\Pessoa', 'pessoa_id');
    }

    public function plano()
    {
        return $this->belongsTo('App\Models\Plano', 'plano_id');
    }

}
