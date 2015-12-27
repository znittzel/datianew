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
        $onGoing = Order::where('status', '=','1')->orWhere('status', '=', '2')->orderBy('created_at')->get();
        $finished = Order::whereStatus('4')->orderBy('created_at', 'decs')->get();

        return view('home', compact('onGoing', 'finished'));
    }
}
