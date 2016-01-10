<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tire;

use App\Classes\Alert;

class TireController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function tires() {
    	return view('tire.tires');
    }

    public function file(Request $request) {
    	Tire::create($request->all());

    	return redirect("/tire")->with("status", Alert::get("success", "Du har lämnat in däck för ".$request->customer_name));
    }
}
