<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;

class ArchiveController extends Controller
{
    public function archive() {
    	$archive = Order::whereStatus('3')->orderBy('order_id')->get();
  
    	return view('archive.archive', compact('archive'));
    }
}
