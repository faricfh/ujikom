<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['nama', 'slug', 'id_kategori', 'harga', 'stok', 'foto', 'deskripsi', 'berat'];
    public $timestamps = true;

    public function kategori()
    {
        return $this->belongsTo('App\Kategori', 'id_kategori');
    }

    public function stokmasuk()
    {
        return $this->hasMany('App\StokMasuk', 'id_produk');
    }

    public function orderdetail()
    {
        return $this->hasMany('App\OrderDetail', 'id_produk');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
