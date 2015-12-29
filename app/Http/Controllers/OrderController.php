<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Order;
use App\OrderEvent;
use Auth;

use App\Classes\Alert;

class OrderController extends Controller
{
    public function show($id) {
    	$order = Order::whereId($id)->first();
        
    	return view('order.order', compact('order'));
    }

    public function edit($id) {
        $order = Order::whereId($id)->first();

        return view('order.edit_order', compact('order'));
    }

    public function update(Request $request, $id) {
        $order = Order::whereId($id)->first();
        
        if (Customer::exists($request->customer_id)) {
            if ($request->order_id != $order->order_id && Order::whereOrder_id($request->order_id)->first())
                return redirect('/order/'.$id.'/edit')->with("status", Alert::get("danger", "Order existerar. Välj annat ordernummer."));

            $order->fill($request->all());
            $order->save();

            return redirect('/order/'.$id.'/edit')->with("status", Alert::get("success", "Order är uppdaterad."));
        } else {
            return redirect('/order/'.$id.'/edit')->with("status", Alert::get("danger", "Kundnummer existerar inte!"));
        }
    }

    public function create() {
        return view('order.create_order');
    }

    public function save(Request $request) {
        $order = new Order();

        if (Customer::whereCustomer_id($request->customer_id)->first()) {
            $order->fill($request->all());
            $order->user_id = Auth::user()->id;
            $order->status = '1';
            $order->save();

            return redirect('/order/'.$order->id.'/show');
        }
        return redirect('/order/create')->with("session", Alert::get("danger", "Något gick snett.. Försök igen!"));        
    }

    public function addComment(Request $request, $id) {
        $order = Order::whereId($id)->first();
        
        if ($request->finished)
            $order->finishIt($request->comment, $request->sign);
        else
            $order->addOrderEvent($request->comment, $request->sign);

        return redirect('order/'.$id.'/show');
    }

    public function archive(Request $request, $id) {
        Order::whereId($id)->first()->archiveIt($request->sign);

        return redirect('home');
    }

    public function return_order(Request $request, $id) {
        $order = Order::whereId($id)->first();
        $order->return_order($request->sign);
        return redirect('/order/'.$order->id.'/show');
    }

    //API
    public function delete(Request $request) {
        $order = Order::whereId($request->id)->first();

        foreach ($order->events as $event) {
            $event->delete();
        }

        return Order::whereId($request->id)->delete();
    }
}
