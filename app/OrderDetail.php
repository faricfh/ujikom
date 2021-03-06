<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = ['id_order', 'id_produk', 'harga', 'qty'];
    public $timestamps = true;

    public function order()
    {
        return $this->belongsTo('App\Order', 'id_order');
    }

    public function produk()
    {
        return $this->belongsTo('App\Produk', 'id_produk');
    }
}
