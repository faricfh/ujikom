<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = ['id_order', 'id_produk', 'harga', 'qty'];
    public $timestamps = true;
}
