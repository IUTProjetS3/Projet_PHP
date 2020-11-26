<?php

require_once File::build_path(['model', 'Livre.php']);

class ControllerLivre {



	public static function readAll(){

		$tab_l = Livre::selectAll();
		$page = "list";
		$controller = "livre";
		$TITLE = "Accueil";
		
		require File::build_path(['view', "view.php"]);
	}

	public static function create(){
		
	}


}