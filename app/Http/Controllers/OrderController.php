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
            $order->setOrderStatus("finished");
        else
            $order->setOrderStatus("started");

        $comment = new OrderEvent();
        $comment->fill($request->all());
        $comment->user_id = Auth::user()->id;
        $comment->order_id = $order->order_id;

        $comment->save();
        $order->save();

        return redirect('order/'.$id.'/show');
    }

    public function archive(Request $request, $id) {
        Order::whereId($id)->first()->archiveIt($request->sign);

        return redirect('home');
    }

    public function return(Request $request, $id) {
        Order::whereId($id)->first()->return();

        return redirect('/order/'.$order->id.'/show');
    }
}
