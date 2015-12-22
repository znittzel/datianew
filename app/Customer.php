<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";

    protected $fillable = [
    	'customer_id',
    	'name',
    	'telephone_number'
    ];

    public function orders() {
    	return $this->hasMany('App\Order');
    }
}
