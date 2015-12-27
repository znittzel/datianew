<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";

    protected $fillable = [
    	'customer_id',
    	'name',
    	'business',
    	'telephone_number'
    ];


    /*
        Hämtar alla ordrar tillhörande denna kunden.
    */
    public function orders() {
    	return $this->hasMany('App\Order');
    }

    /*
        Om denna kunden är ett företag.
    */
    public function isBusiness() {
        return ($this->business ? true : false);
    }
}
