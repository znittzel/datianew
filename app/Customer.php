<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Classes\Alert;

class Customer extends Model
{
    protected $table = "customers";

    protected $fillable = [
    	'customer_id',
    	'name',
    	'business',
    	'telephone_number',
        'reputation'
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
        Ger tillbaka en html "label" beroende på $this->business.
    */
    public function getLabelForBusiness() {
        if ($this->isBusiness())
            return Alert::getLabel("primary", "Företag");
        else
            return Alert::getLabel("default", "Privat");
    }

    /*
        Ger tillbaka en html "label" beroende på $this->reputation.
    */
    public function getLabelForReputation() {
        return Alert::getLabel($this->getStatusByReputation()['status'], $this->getStatusByReputation()['message']);
    }

    /*
        Kollar om kund existerar.
    */
    public static function exists($customer_id) {
        return (Customer::whereCustomer_id($customer_id)->first() ? true : false);
    }

    public function getStatusByReputation() {
        switch ($this->reputation) {
            case 0:
                return [
                    'status' => 'default',
                    'message' => 'Inget omdöme'
                    ];
                break;
            case 1:
                return [
                    'status' => 'warning',
                    'message' => 'Problem med betalning'
                ];
                break;
            case 2:
                return [
                    'status' => 'danger',
                    'message' => 'Faktureras ej'
                ];
                break;
        }
    }
}