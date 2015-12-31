<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Datatables;

class DatatablesController extends Controller
{
    public function getIndex() {
    	return view('datatables.index');
    }

    public function anyData() {
    	return Datatables::of(User::select('*'))->make(true);
    }
}
