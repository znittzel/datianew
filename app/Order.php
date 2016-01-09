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
    	'reg_number',
    	'accessories',
        'password',
        'place',
    	'status',
        'prio',
    	'sign',
        'event_id',
        'estimated_time',
        'booked_at',
        'pickup_at',
        'finished_at',
    	'created_at',
    	'updated_at'
    ];

    /*
        Hämtar kunden tillhörande denna ordern.
    */
    public function customer() {
    	return $this->belongsTo('App\Customer', 'customer_id', 'customer_id');
    }


    /*
        Hämtar användaren tillhörande denna ordern.
    */
    public function user() {
    	return $this->belongsTo('App\User', 'user_id', 'user_id');
    }

    /*
        Hämtar alla OrderEvents tillhörande denna ordern.
    */
    public function events() {
    	return $this->hasMany('App\OrderEvent', 'order_id', 'order_id');
    }

    public function articles() {
        return $this->hasMany('App\Article', 'order_id', 'order_id');
    }

    /**
     * Hämtar kalender-eventet
     * @return Event::class 
     */
    public function event() {
        return $this->hasOne('App\Event', 'order_id', 'order_id');
    }

    /*
        Hämtar rätt style utefter orderstatus. Används i olika views
    */
    public function state() {
        if (!($this->status == '3' || $this->status == '4')) {
            if (!$this->prio) {
                if (!$this->customer()->first()->business) {
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
                    case '2':
                        return "default";
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
        $this->addOrderEvent("Order avslutad och utlämnad", $sign);
    }

    /*
        Slår tillbaka arkiverad order till påbörjad.
    */
    public function return_order($sign) {
        $this->setOrderStatus('started');
        $this->addOrderEvent("Order återinförd i ordersystemet.", $sign);
    }

    /*
        Lägger till ett OrderEvent (kommentar).
    */
    public function addOrderEvent($comment, $sign) {
        $orderEvent = new OrderEvent();
        $orderEvent->comment = htmlentities($comment);
        $orderEvent->sign = $sign;
        $orderEvent->user_id = Auth::user()->id;
        $orderEvent->order_id = $this->order_id;
        
        $orderEvent->save();
    }

    /*
        Hämtar första knytna orderevent
    */
    public function startedAt() {
        if ($this->events()->count() != 0)
            return date("Y-m-d", strtotime($this->events()->first()->created_at));
        else
            return '<i>Ej påbörjad</i>';
    }

    /*
        Hämtar sista knytna orderevent
    */
    public function finishedAt() {
        if ($this->events()->count() != 0)
            return date("Y-m-d", strtotime($this->events()->orderBy('order_event_id', 'desc')->first()->created_at));
        else 
            return '<i>Ej avslutad</i>';
    }

    /**
     * Returnerar true eller false beroende på om order existerar 
     * @param  $order_id
     * @return boolean
     */
    public static function exists($id) {
        return (Order::whereOrder_id($id)->first() ? true : false);
    }
}
