<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profissao extends Model
{
    protected $table = 'profissoes';

    protected $fillable = [
        'descricao', 'status'
    ];

    public $timestamps = false;


    /*public function category()
    {
        return $this->belongsTo('\App\Models\Category');
    }*/
}
