<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\OrderEvent;

class OrderEventController extends Controller
{
    public function delete(Request $request) {
        return OrderEvent::whereOrder_event_id($request->order_event_id)->delete();
    }
}
