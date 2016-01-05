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
        $private = Order::where('status', '=','1')
                    ->orWhere('status', '=', '2')
                    ->orderBy('order_id', 'desc')
                    ->with("customer")
                    ->get();
        $company = Order::where('status', '=','1')
                    ->orWhere('status', '=', '2')
                    ->orderBy('order_id', 'desc')
                    ->with("customer")
                    ->get();
        $prio = Order::where('prio', '=', '1')
                ->whereRaw('(status = 1 OR status = 2)')
                ->orderBy('order_id')
                ->with("customer")
                ->get();
        $finished = Order::whereStatus('4')
                ->with(['customer' => function($query) {
                    $query->where('business', '=', '1');
                }])
                ->get();

        dd($finished);

        return view('home', compact('private', 'company', 'prio', 'finished'));
    }
}
