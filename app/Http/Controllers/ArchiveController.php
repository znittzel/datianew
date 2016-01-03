<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use Datatables;
use Yajra\Datatables\Html\Builder;

class ArchiveController extends Controller
{
	/**
     * Datatables Html Builder
     * @var Builder
     */
    protected $htmlBuilder; 

    public function __construct(Builder $builder) {
        $this->htmlBuilder = $builder;
        $this->middleware('auth');
    }

    public function archive(Request $request) {
    	if($request->ajax()) {
    		$orders = Order::select('*')->whereStatus("3")->with("customer")->get();

    		return Datatables::of($orders)
                    ->editColumn('order_id', function($order) {
                        return '<a href="/order/'.$order->id.'/show">'.$order->order_id.'</a>';
                    })
    				->editColumn('customer_name', function($order) {
    					return '<a href="/customer/'.$order->customer->id.'/show">'.$order->customer->name.'</a>';
    				})
                    ->editColumn('started_at', function($order) {
                        return $order->startedAt();
                    })
                    ->editColumn('finished_at', function($order) {
                        return $order->finishedAt();
                    })
    				->make(true);
    	}

    	$html = $this->htmlBuilder
    				->addColumn(['data' => 'order_id', 'name' => 'order_id', 'title' => 'Ordernr'])
                    ->addColumn(['data' => 'customer_name', 'name' => 'customer_name', 'title' => 'Kund'])
                    ->addColumn(['data' => 'started_at', 'name' => 'started_at', 'title' => 'Påbörjad'])
    				->addColumn(['data' => 'finished_at', 'name' => 'finished_at', 'title' => 'Avslutad']);

    	return view('archive.archive', compact('html'));
    }
}
