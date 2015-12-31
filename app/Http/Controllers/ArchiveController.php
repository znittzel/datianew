<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use DB;

class ArchiveController extends Controller
{
    public function archive(Request $request) {
    	$sortBy = 'id';
        if ($request->input('sort') !== null)
            $sortBy = $request->input('sort');

		$archive = Order::orderBy($sortBy)->paginate(10);

    	return view('archive.archive', compact('archive'));
    }
}
