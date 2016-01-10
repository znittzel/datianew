<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tire;
use App\Customer;

use App\Classes\Alert;

class TireController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function tires() {
        $customers = Customer::select(["customer_id", "name"])->orderBy('name')->get();
    	return view('tire.tires', compact('customers'));
    }

    public function file(Request $request) {
    	$tire = Tire::create($request->all());
    	return redirect("/tire")->with("status", Alert::get("success", "Du har lämnat in däck för kunden <b>".$tire->customer()->first()->name.'</b>'));
    }
}
