<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $fillable = ['kirim_dari', 'kirim_ke', 'pesan'];
    public $timestamps = true;

    public function akunchat()
    {
        return $this->belongsTo('App\AkunChat', 'id_customer');
    }
}
