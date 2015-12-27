<?php

	namespace App\Classes;

class Alert {
	public static function get($state, $message) {
		return '<div class="alert alert-'.$state.'"> '.$message.' </div>'; 
	}
}