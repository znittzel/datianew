<?php

	namespace App\Classes;

class Alert {
	public static function get($state, $message) {
		return '<div class="alert alert-dismissible alert-'.$state.'">
				  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
				  '.$message.'
				</div>'; 
	}

	public static function getLabel($state, $message) {
		return '<span class="label label-'.$state.'">'.$message.'</span>';
	}
}