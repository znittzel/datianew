<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    $table = "groups";

    $fillabel = [
    	'name',
    	'permissions'
    ];

    public function users() {
    	$this->hasMany("App\User");
    }
}
