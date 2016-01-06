<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;
use Datatables;
use Yajra\Datatables\Html\Builder;

class ArticleController extends Controller
{	
	public function __construct() {
		$this->middleware("auth");
	}


	/**
	 * Lägger till $i antal artiklar på order
	 * @param Request $request
	 */
	public function add(Request $request) {
		for ($i = 0; $i < $request->quantity; $i++)
			Article::create($request->all());
	}
}