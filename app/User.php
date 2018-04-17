<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'login';

    protected $username = 'usuario';

    public $timestamps = false;

    protected $fillable = ['usuario', 'password', 'nivel_id', 'pessoa_id'];

    protected $hidden = ['password', ];

    /**
     * Get the password for the user.
     * Atribuindo o valor do password para o atributo que significa a senha na tabela
     *
     * @return string
     */
    public function getAuthPassword() {
        return Hash::make($this -> password);
        //return $this->usr_senha;
    }

    /**
     * Overrides the method to ignore the remember token.
     * Removendo a obrigatoriedade da tabela de autenticação ter o atributo "remenber_token"
     */
    public function setAttribute($key, $value) {
        $isRememberTokenAttribute = $key == $this -> getRememberTokenName();
        if (!$isRememberTokenAttribute) {
            parent::setAttribute($key, $value);
        }
    }
}
