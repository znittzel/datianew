<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Customer;

class CustomerController extends Controller
{
	public function home() {
		$customers = Customer::all();

		return view('customer.customer', compact('customers'));
	}

    public function show($id) {
    	$customer = Customer::whereId($id)->first();

    	return view("customer.show_customer", compact("customer"));
    }

    public function update(Request $request, $id) {
    	$customer = Customer::whereId($id)->first();

    	$customer->fill($request->all());
    	$customer->save();

    	return redirect('/customer/'. $id);
    }
}
