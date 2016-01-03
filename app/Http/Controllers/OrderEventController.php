<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\OrderEvent;

class OrderEventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function delete(Request $request) {
        return OrderEvent::whereOrder_event_id($request->order_event_id)->delete();
    }

    public function edit($id) {
    	$orderevent = OrderEvent::whereOrder_event_id($id)->first();

    	return view("orderevent.edit", compact('orderevent'));
    }

    public function update(Request $request, $id) {
    	$orderevent = OrderEvent::whereOrder_event_id($id)->first();
    	$orderevent->fill($request->all());
    	$orderevent->push();

    	return redirect('/order/'.$orderevent->order()->id.'/edit');
    }
}
