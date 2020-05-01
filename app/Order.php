<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['invoice', 'id_customer', 'nama_customer', 'phone_customer', 'provinsi', 'kota', 'alamat_customer', 'subtotal'];
    public $timestamps = true;

    public function customer()
    {
        return $this->belongsTo('App\Order', 'id_customer');
    }

    public function orderdetail()
    {
        return $this->hasMany('App\OrderDetail', 'id_order');
    }

    /**
     * Set status to Pending
     *
     * @return void
     */
    public function setPending()
    {
        $this->attributes['status'] = 'pending';
        self::save();
    }

    /**
     * Set status to Success
     *
     * @return void
     */
    public function setSuccess()
    {
        $this->attributes['status'] = 'success';
        self::save();
    }

    /**
     * Set status to Failed
     *
     * @return void
     */
    public function setFailed()
    {
        $this->attributes['status'] = 'failed';
        self::save();
    }

    /**
     * Set status to Expired
     *
     * @return void
     */
    public function setExpired()
    {
        $this->attributes['status'] = 'expired';
        self::save();
    }
}
