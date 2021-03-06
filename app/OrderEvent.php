<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class OrderEvent extends Model
{   
    protected $primaryKey = 'order_event_id';
    protected $fillable = [
    	'order_event_id',
    	'order_id',
    	'user_id',
    	'comment',
    	'sign'
    ];

    public function order() {
    	return $this->hasOne('App\Order', 'order_id', 'order_id')->first();
    }

    public function user() {
    	return $this->hasOne('App\User', 'user_id', 'id')->first();
    }
}
