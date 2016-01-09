<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = "groups";

    protected $fillabel = [
    	'name',
    	'permissions'
    ];

    public function users() {
    	$this->hasMany("App\User");
    }
}
