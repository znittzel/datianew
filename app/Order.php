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

    public function state() {
        if ($this->status !== '3' || $this->status !== '4') {
            if (!$this->prio) {
                if (!$this->customer()->first()->business) {
                    switch ($this->status) {
                        case '1':
                            return "danger";
                            break;
                        case '2':
                            return "warning";
                            break;
                        default:
                            # code...
                            break;
                    }
                } else {
                    switch ($this->status) {
                        case '1':
                            return "primary";
                            break;
                        case '2':
                            return "info";
                            break;
                        default:
                            # code...
                            break;
                    }
                }
            } else {
                switch ($this->status) {
                    case '1':
                        return "high-prio";
                        break;
                    
                    default:
                        # code...
                        break;
                }
            }
        } else {
            switch ($this->status) {
                case '3':
                    return "success";
                    break;
                case '4':
                    return "light-success";
                    break;
            }
        }
    }
}
