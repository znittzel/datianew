<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;
use Yajra\Datatables\Html\Builder;
use App\ArticlesList;
use App\Classes\Alert;

class ArticlesListController extends Controller
{
    /**
	 * Bygger htmlkod för tabell 
	 * @var Builder::class
	 */
	protected $htmlBuilder;

    /**
     * Auktoriseringsskydd + htmlbuilder
     * @param Builder $builder 
     */
    public function __construct(Builder $builder) {
    	$this->middleware("auth");
    	$this->htmlBuilder = $builder;
    } 

    /**
     * Hämtar vy tillsammans med dynamisk Yajra-table
     * @param  Request $request AJAX 
     * @return articles.blade.php, (html-kod)
     */
    public function index(Request $request) {
    	if ($request->ajax()) {
    		$articles = ArticlesList::select("*")->get();

    		return Datatables::of($articles)
                    ->editColumn('name', function($article) {
                        return '<a href="/article/'.$article->id.'/show">'.$article->name.'</a>';
                    })
                    ->make(true);
    	}

    	$html = $this->htmlBuilder
    				->addColumn(['data'=>'id', 'name'=>'id', 'title'=>'#'])
                    ->addColumn(['data'=>'article_id', 'name'=>'article_id', 'title'=>'Artikelnr'])
    				->addColumn(['data'=>'name', 'name'=>'name', 'title'=>'Benämning'])
    				->addColumn(['data'=>'unit', 'name'=>'unit', 'title'=>'Enhet']);

    	return view("article.articles", compact('html'));
    }

    /**
     * Hämta vy
     * @return articles.blade.php
     */
    public function create() {
        return view('article.create_article');
    }

    /**
     * Sparar en ny artikel
     * @param  Request $request 
     * @return articles.blade.php
     */
    public function save(Request $request) {
        ArticlesList::create($request->all());

        return redirect('/article')->with("status", Alert::get("success", "Du har skapat en artikel."));
    }

    /**
     * Om artikel existerar
     * @param  string $id
     * @return [exists => boolean]
     */
    public function exists($id) {
        return ['exists' => ArticlesList::exists($id)];
    }
}
