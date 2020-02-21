<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KabupatenKota extends Model
{
    protected $table = 'indonesia_cities';
    protected $fillable = ['name'];
}
