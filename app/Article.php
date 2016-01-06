<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	/**
	 * Artiklar i databasen
	 * @var string
	 */
    protected $table = "articles";

    /**
     * Massassignment attribute
     * @var []
     */
    protected $fillable = [
    	"order_id",
    	"articles_list_id",
        "sign"
    ];

    /**
     * Artikelinformation
     * @return ArtlclesList::class
     */
    public function article_list() {
    	return $this->belongsTo("App\ArticlesList", "articles_list_id", "id");
    }

    /**
     * Order tillhörande artikeln
     * @return Order::class 
     */
    public function order() {
    	return $this->belongsTo("App\Order", "order_id", "id");
    }
}
