<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = ['id_order', 'id_customer', 'tgl', 'jmlh', 'total'];
    public $timestamps = true;

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'id_customer');
    }

    public function order()
    {
        return $this->belongsTo('App\Order', 'id_order');
    }
}
