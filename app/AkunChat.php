<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AkunChat extends Model
{
    protected $fillable = ['nama', 'email'];
    public $timestamps = true;

    public function pesan()
    {
        return $this->hasMany('App\Pesan', 'id_customer');
    }
}
