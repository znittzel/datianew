<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

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
        'password',
        'box',
    	'status',
        'prio',
    	'sign',
    	'created_at',
    	'updated_at'
    ];

    /*
        Hämtar kunden tillhörande denna ordern.
    */
    public function customer() {
    	return $this->hasOne('App\Customer', 'customer_id', 'customer_id')->first();
    }


    /*
        Hämtar användaren tillhörande denna ordern.
    */
    public function user() {
    	return $this->hasOne('App\User', 'user_id', 'user_id')->first();
    }

    /*
        Hämtar alla OrderEvents tillhörande denna ordern.
    */
    public function events() {
    	return $this->hasMany('App\OrderEvent', 'order_id', 'order_id');
    }

    /*
        Hämtar rätt style utefter orderstatus. Används i olika views
    */
    public function state() {
        if (!($this->status == '3' || $this->status == '4')) {
            if (!$this->prio) {
                if (!$this->customer()->business) {
                    switch ($this->status) {
                        case '1':
                            return "danger";
                            break;
                        case '2':
                            return "warning";
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
                    }
                }
            } else {
                switch ($this->status) {
                    case '1':
                        return "high-prio";
                        break;
                }
            }
        } else {
            switch ($this->status) {
                case '3':
                    return "default";
                    break;
                case '4':
                    return "success";
                    break;
            }
        }
    }

    /*
        Hämtar rätt style utefter orderstatus. Används i olika views
    */
    public function stateName() {
        switch ($this->status) {
            case '1':
                return 'Ej påbörjad';
                break;
            case '2':
                return 'Påbörjad';
            case '3':
                return 'Arkiverad';
                break;
            case '4':
                return 'Avslutad';
                break;
        }
    }

    /*
        Ändrar orderstatus utefter meddelande "started" (påbörjad), "archived" (arkiverad) 
        och "finished" (avslutad, ej utlämnad). 
    */
    public function setOrderStatus($state) {
             switch ($state) {
                case 'started':
                    $this->status = '2';
                    break;

                case 'archived':
                    $this->status = '3';
                    break;

                case 'finished':
                    $this->status = '4';
                    break;
            }

        $this->push();
    }

    /*
        Kommenterar på order.
    */
    public function commentIt($comment, $sign) {
        $this->setOrderStatus("started");
        $this->addOrderEvent($comment, $sign);
    }

    /*
        Avslutar order.
    */
    public function finishIt($comment, $sign) {
        $this->setOrderStatus("finished");
        $this->addOrderEvent($comment, $sign);
    }

    /*
        Arkiverar order och lägger till en slutkommentar.
    */
    public function archiveIt($sign) {
        $this->setOrderStatus('archived');
        $this->addOrderEvent("<i>Order avslutad och utlämnad</i>", $sign);
    }

    /*
        Slår tillbaka arkiverad order till påbörjad.
    */
    public function return_order($sign) {
        $this->setOrderStatus('started');
        $this->addOrderEvent("<i>Order återinförd i ordersystemet.</i>", $sign);
    }

    /*
        Lägger till ett OrderEvent (kommentar).
    */
    public function addOrderEvent($comment, $sign) {
        $orderEvent = new OrderEvent();
        $orderEvent->comment = $comment;
        $orderEvent->sign = $sign;
        $orderEvent->user_id = Auth::user()->id;
        $orderEvent->order_id = $this->order_id;
        
        $orderEvent->save();
    }
}
