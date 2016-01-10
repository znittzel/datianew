<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TireController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function tires() {
    	return view('tire.tires');
    }
}
