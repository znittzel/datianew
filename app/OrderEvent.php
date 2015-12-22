<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderEvent extends Model
{
    protected $table = "order_events";

    protected $fillable = [
    	'order_event_id',
    	'order_id',
    	'user_id',
    	'comment',
    	'sign'
    ];

    public function order() {
    	return $this->hasOne('App\Order', 'order_id', 'order_id');
    }

    public function user() {
    	return $this->hasOne('App\User', 'user_id', 'id');
    }
}
