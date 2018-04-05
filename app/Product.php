<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const PRODUCTO_DISPONIBLE = 'disponible';
    const PRODUCTO_NO_DISPONIBLE = 'no disponible';


    protected $fillable = ['name', 'description', 'quantity', 'status','image','seller_id'];

    /**
     * Retorna si el producto esta disponible o no
     * @return string
     */
    public function isAvailable() {
        return $this->status == Product::PRODUCTO_DISPONIBLE;
    }

    /*
     * Obteniendo las categorias a traves de la relacion muchos a muchos
     */
    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    /*
     * Obteniendo las categorias a traves de la relacion muchos a muchos
     */
    public function transaction() {
        return $this->hasMany(Transaction::class);
    }

    /*
     * Obteniendo el vendedor del producto a traves de la relacion uno a muchos
     */
    public function seller() {
        return $this->belongsTo(Seller::class);
    }

}
