<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NivelAcesso extends Model
{

    protected $guarded = [];

    public $timestamps = false;

    public function user()
    {
        return $this->hasMany('App\User', 'nivel_id');
    }
}
