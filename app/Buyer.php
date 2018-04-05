<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends User
{
    /*
     * Obteniendo la transaccion que el comprador puede realizar
     * Un comprador puede hacer muchas transacciones
     */
    public function transaction () {
        return $this->hasMany(Transaction::class);
    }



}
