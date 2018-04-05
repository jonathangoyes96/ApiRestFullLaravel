<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // Si el usuario esta verificado  o no
    const VERIFIED_USER = '1';
    const NOT_VERIFIED_USER = '0';

    // Si el usuario es administrador o no
    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','verified','verification_token','admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * Los atributos que definamos aqui no seran mostrados como respuesta JSON
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'verification_token',
    ];

    /**
     * Retorna si el usuario esta verificado por el email o no
     * @return string
     */
    public function isVerified() {
        return $this->verified == User::VERIFIED_USER;
    }

    /*
     * Retorna si un usuario es administrador
     */
    public function isAdminUser() {
        return $this->admin == User::ADMIN_USER;
    }

    /*
     * Retorna un token de verification aleatorio para el usuario
     */
    public static function generateVerificationToken (){
        return str_random(40);
    }

}
