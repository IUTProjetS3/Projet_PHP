<?php

require_once File::build_path(['model', 'Livre.php']);

class ControllerLivre {



	public function readAll(){
		
		$tab_l = Livre::selectAll();
		$page = "list";
		$controller = "livre";
		$TITLE = "Liste des livres";
		File::build_path(['view', "view.php"]);
	}


}