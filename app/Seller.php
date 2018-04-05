<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends User
{
    /*
     * Obteniendo los productos relacion uno a muchos
     * Un vendedor tiene muchos productos
     */
    public function products() {
        $this->hasMany(Product::class);
    }
}
