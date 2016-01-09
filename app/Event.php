<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
    	'title',
    	'order_id',
    	'start',
    	'end'
    ];

    public function order() {
    	return $this->hasOne('App\Order', 'order_id', 'order_id');
    }
}
