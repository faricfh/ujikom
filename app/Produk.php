<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['nama', 'slug', 'id_kategori', 'harga', 'stok', 'foto', 'konten'];
    public $timestamps = true;

    public function kategori()
    {
        return $this->belongsTo('App\Kategori', 'id_kategori');
    }

    public function order()
    {
        return $this->belongsToMany('App\Order', 'order_produk', 'id_produk', 'id_order');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
