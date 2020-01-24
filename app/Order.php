<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['tgl', 'jmlh', 'total', 'id_customer'];
    public $timestamps = true;

    public function produk()
    {
        return $this->belongsToMany('App\Produk', 'order_produk', 'id_order', 'id_produk');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'id_customer');
    }

    public function transaksi()
    {
        return $this->hasOne('App\Transaksi', 'id_order');
    }
}
