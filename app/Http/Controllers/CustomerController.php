<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Classes\Alert;
use App\Http\Input;

class CustomerController extends Controller
{
	public function home(Request $request) {
        
		$customers = Customer::all();

        return view('customer.customer', compact('customers'));
	}

    public function show($id) {
    	$customer = Customer::whereId($id)->first();

    	return view("customer.show_customer", compact("customer"));
    }

    public function create() {
        return view("customer.create_customer");
    }

    public function save(Request $request) {
        if (!Customer::whereCustomer_id($request->customer_id)->first()) {
            $customer = new Customer();

            $customer->fill($request->all());
            $customer->save();

            return redirect("/customer/".$customer->id."/show");
        } else {
            return redirect("/customer/create")->with("status", Alert::get("danger", "Kund ".$request->customer_id." existerar, försök igen."));
        }
    }

    public function update(Request $request, $id) {
    	$customer = Customer::whereId($id)->first();

    	$customer->fill($request->all());
    	$customer->push();

    	return redirect('/customer/'. $id .'/show')->with('status', Alert::get('success', 'Informationen är uppdaterad.'));
    }

    public function get($id) {
        return Customer::whereCustomer_id($id)->first();
    }

    public function getAll() {
        dd(Customer::paginate(15));
    }
}
