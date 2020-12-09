<?php


class Controller{

	public static function error(){
		$page = '../error';
		$controller = 'livre';
		$TITLE = 'Erreur';
		require File::build_path(['view', 'view.php']);
	}
}