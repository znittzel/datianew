<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Classes\Alert;
use App\Http\Input;
use Datatables;
use Yajra\Datatables\Html\Builder;

class CustomerController extends Controller
{   
    /**
     * Datatables Html Builder
     * @var Builder
     */
    protected $htmlBuilder; 

    public function __construct(Builder $htmlB) {
        $this->htmlBuilder = $htmlB;
    }

	public function home(Request $request) {
        if ($request->ajax()) {
            return Datatables::of(Customer::select('*'))->make(true);
        }

        $html = $this->htmlBuilder
                ->addColumn(['data' => 'id', 'name' => 'id', 'title' => '#'])
                ->addColumn(['data' => 'customer_id', 'name' => 'customer_id', 'title' => 'Kundnr'])
                ->addColumn(['data' => 'name', 'name' => 'name', 'title' => 'Namn'])
                ->addColumn(['data' => 'telephone_number', 'name' => 'telephone_number', 'title' => 'Telefonnr']);

        return view('customer.customer', compact('html'));
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
}
