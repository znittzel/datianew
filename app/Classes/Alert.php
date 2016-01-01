<?php

	namespace App\Classes;

class Alert {
	public static function get($state, $message) {
		return '<div class="alert alert-'.$state.'"> '.$message.' </div>'; 
	}

	public static function getLabel($state, $message) {
		return '<span class="label label-'.$state.'">'.$message.'</span>';
	}
}