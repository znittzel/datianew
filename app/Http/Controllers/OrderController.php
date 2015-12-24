<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderEvent;
use Auth;

class OrderController extends Controller
{
    public function show($id) {
    	$order = Order::whereOrder_id($id)->first();

    	return view('order', compact('order'));
    }

    public function addComment(Request $request, $id) {

        if ($request->finished)
            setOrderStatus($id, "finished");
        else
            setOrderStatus($id, "started");

        $comment = new OrderEvent();
        $comment->fill($request->all());

        $comment->order_id = $id;
        $comment->user_id = Auth::user()->id;

        $comment->save();

        return redirect('order/'.$id);
    }

    public function setOrderStatus($id, $state) {
        $order = Order::whereId($id)->first();

        switch ($state) {
            case 'started':
                if ($order->status == 1 || $order->status == 3)
                    $order->status = 2;
                else if ($order->status == 5 || $order->status == 7)
                    $order->status == 6;
                break;

            case 'finished':
                $order->status = 4;
                break;
        }

    }
}
