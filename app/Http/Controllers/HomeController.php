<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {        
        $business = Order::where('status', '=','5')->orWhere('status', '=', '6')->orderBy('created_at')->get();
        $private = Order::where('status', '=','1')->orWhere('status', '=', '2')->orderBy('created_at')->get();
        $finished = Order::whereStatus('4')->get();

        return view('home', compact('business','private', 'finished'));
    }
}
