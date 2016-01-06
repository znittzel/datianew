<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;
use Datatables;
use Yajra\Datatables\Html\Builder;
use App\ArticlesList;

class ArticleController extends Controller
{	
	public function __construct() {
		$this->middleware("auth");
	}


	/**
	 * Lägger till artikel på order
	 * @param Request $request
	 */
	public function add(Request $request) {
		$articles_list_id = ArticlesList::whereArticle_id($request->article_id)->first()->id;
		$article = new Article();
		$article->fill($request->all());
		$article->articles_list_id = $articles_list_id;
		$article->save();
	}

	public function delete(Request $request) {
		if (Article::whereId($request->id)->first()->delete())
			return 1;
		else
			return 0;
	}
}