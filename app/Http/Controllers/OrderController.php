<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends Controller
{
    public function show($id) {
    	$order = Order::whereOrder_id($id)->first();

    	$style = ['panel' => ""];

    	switch ($order->status) {
    		case '1':
    			$style['panel'] = "danger";
    			break;
    		case '2':
    			$style['panel'] = "warning";
    			break;
    		case '4':
    			$style['panel'] = "success";
    			break;
    		case '5':
    			$style['panel'] = "primary";
    			break;
    		case '6':
    			$style['panel'] = "info";
    			break;
    		default:
    			# code...
    			break;
    	}

    	return view('order', compact('order', 'style'));
    }
}
