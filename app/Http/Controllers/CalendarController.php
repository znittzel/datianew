<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;

class CalendarController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function index() {
    	return view('calendar.calendar');
    }

    public function events(Request $request) {
    	if ($request->start && $request->end)
    		return Event::whereRaw("start between '".$request->start."' and '".$request->end."'")->get();
    	else
    		return Event::select("*")->get();
    }
}
