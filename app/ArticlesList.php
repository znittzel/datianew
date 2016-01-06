<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticlesList extends Model
{
	/**
	 * Table "articles_list"
	 * @var string
	 */
    protected $table = "articles_list";

    /**
     * Massassignment attributes
     * @var [type]
     */
    protected $fillable = [
    	"article_id",
        "name",
    	"price",
    	"unit"
    ];

    /**
     * Artiklar med knytpunkt till denna Artikelinformationen
     * @return Article::class
     */
    public function articles() {
    	return $this->hasMany('App\Article');
    }

    /**
     * Om artikel existerar
     * @param  string $id 
     * @return boolean
     */
    public static function exists($id) {
        return (ArticlesList::whereArticle_id($id)->first() ? true : false);
    }
}
