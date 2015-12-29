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
    	return $this->hasMany('App\Order', 'customer_id', 'customer_id')->orderBy('order_id', 'desc');
    }

    /*
        Om denna kunden är ett företag.
    */
    public function isBusiness() {
        return ($this->business ? true : false);
    }

    /*
        Kollar om kund existerar.
    */
    public static function exists($customer_id) {
        return (Customer::whereCustomer_id($customer_id)->first() ? true : false);
    }
}