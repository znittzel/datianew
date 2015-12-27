<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Order;
use App\OrderEvent;
use Auth;

class OrderController extends Controller
{
    public function show($id) {
    	$order = Order::whereId($id)->first();
        
    	return view('order.order', compact('order'));
    }

    public function create() {
        $customers = Customer::orderBy('name')->get();
        return view('order.create_order', compact("customers"));
    }

    public function save(Request $request) {
        $order = new Order();

        $order->fill($request->all());
        $order->user_id = Auth::user()->id;
        $order->status = '1';
        $order->save();

        return redirect('/order/'.$order->id.'/show');        
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
}
