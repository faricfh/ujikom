<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StokKeluar extends Model
{
    protected $fillable = ['id_produk', 'qty', 'tgl'];
    public $timestamps = true;

    public function produk()
    {
        return $this->belongsTo('App\Produk', 'id_produk');
    }
}
