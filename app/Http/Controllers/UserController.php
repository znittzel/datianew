<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Classes\Alert;
use Auth;
use Hash;

class UserController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function create() {
    	if (Auth::user()->isAdmin()) {
    		return view('admin.create_user');
    	}

    	return redirect('/')->with('status', Alert::get('danger', 'Du är inte administratör.'));
    }

    public function exists($email) {
    	return ["exists" => User::exists($email)];
    }

    public function save(Request $request) {
    	if (!User::exists($request->email) && ($request->password == $request->password_again))
    	{
    		$user = new User();
    		$user->password = Hash::make($request->password);
    		$user->name = $request->name;
    		$user->email = $request->email;
    		$user->group_id = $request->group_id;

    		$user->save();
    		return redirect('/')->with("status", Alert::get("success", $user->name." kan nu logga in."));
    	}

    	return redirect('/admin/create_user')->with("status", Alert::get("danger", "Krav för form stämmer inte överens. Kontrollera: Email, lösenord"));
    }
}
