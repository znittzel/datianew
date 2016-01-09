<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'group'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders() {
        return $this->hasMany('App\Order');
    }

    public function order_events() {
        return $this->hasMany('App\OrderEvent');
    }

    /** 
     * Om administratör
     * @return boolean 
     */
    public function isAdmin() {
        $permissions = json_decode(DB::table('groups')->whereId($this->group_id)->first()->permissions);

        if ($permissions->administrator)
            return true;
        
        return false;
    }

    /**
     * Om email existerar
     * @param  string $email 
     * @return boolean
     */
    public static function exists($email) {
        return (User::whereEmail($email)->first() ? true : false);
    }
}
