<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = ['id_order', 'id_user', 'tgl', 'jmlh'];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function order()
    {
        return $this->belongsTo('App\Order', 'id_order');
    }
}
