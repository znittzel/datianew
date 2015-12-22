<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $fillable = [
    	'order_id',
    	'customer_id',
    	'user_id',
    	'context',
    	'type',
    	'accessories',
    	'status',
    	'sign',
    	'created_at',
    	'updated_at'
    ];

    public function customer() {
    	return $this->hasOne('App\Customer', 'customer_id', 'customer_id');
    }

    public function user() {
    	return $this->hasOne('App\User', 'user_id', 'user_id');
    }

    public function events() {
    	return $this->hasMany('App\OrderEvent', 'order_id', 'order_id');
    }
}
