<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['tgl', 'total', 'id_user'];
    public $timestamps = true;

    public function produk()
    {
        return $this->belongsToMany('App\Produk', 'order_produk', 'id_order', 'id_produk');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function transaksi()
    {
        return $this->hasOne('App\Transaksi', 'id_order');
    }
}
