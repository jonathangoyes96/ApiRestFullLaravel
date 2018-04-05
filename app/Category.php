<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    /*
     * Obteniendo los productos a traves de la relacion
     * Una categoria tiene muchos productos y los productos pertenecen a varias categorias
     */
    public function products() {
        return $this->belongsToMany(Product::class);
    }

}
