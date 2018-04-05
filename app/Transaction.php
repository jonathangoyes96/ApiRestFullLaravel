<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['quantity', 'buyer_id', 'product_id'];

    /*
     * Obteniendo el comprador mediante la relacion una muchos
     * Una transaccion pertenece a un comprador
     */
    public function buyer() {
        return $this->belongsTo(Buyer::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

}
