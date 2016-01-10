<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tire extends Model
{
    protected $table = "tires";

    protected $fillable = [
    	'customer_id',
    	'reg_number',
    	'position',
    	'number_of_tires',
    	'quality',
    	'type',
    	'filed_at',
    	'returned_at'
    ];

    /**
     * Ägs av kund
     * @return Customer::class
     */
    public function customer() {
    	return $this->belongsTo('App\Customer', 'customer_id', 'customer_id');
    }
}
