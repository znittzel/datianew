<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;
use App\Order;

class CalendarController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function index() {
    	return view('calendar.calendar');
    }

    public function events(Request $request) {
    	if ($request->start && $request->end)
    		return Event::whereRaw("start between '".$request->start."' and '".$request->end."'")->with("order")->get();
    	else
    		return Event::select("*")->get();
    }

    public function getEvent($id) {
        $order = Order::whereOrder_id($id)->first();
        $event = Event::whereOrder_id($id)->first();
        return [
            'order' => $order, 
            'customer' => $order->customer()->first(), 
            'event' => $event
            ];
    }
}
