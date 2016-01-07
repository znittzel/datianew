<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
    	'title',
    	'order_id',
    	'estimated_time',
    	'start',
    	'end'
    ];

    public function order() {
    	return $this->hasOne('App\Order', 'order_id', 'id');
    }
}
