<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['invoice', 'id_customer', 'nama_customer', 'phone_customer', 'alamat_customer', 'subtotal'];
    public $timestamps = true;
}
