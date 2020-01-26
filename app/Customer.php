<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['nama', 'email', 'no_tlp', 'alamat', 'status'];
    public $timestamps = true;
}
