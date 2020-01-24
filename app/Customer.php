<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['nama', 'email', 'no_tlp', 'alamat', 'password'];
    protected $hidden = ['password'];
    public $timestamps = true;

    public function order()
    {
        return $this->hasMany('App\Order', 'id_customer');
    }

    public function transaksi()
    {
        return $this->hasMany('App\Transaksi', 'id_customer');
    }
}
