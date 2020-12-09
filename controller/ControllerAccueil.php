<?php
	
	/**
	 * 
	 */
	class ControllerAccueil extends Controller
	{
		
		public static function accueil(){
            $TITLE = "Accueil";

            $controller = "accueil";
			$page = "index";
			$TITLE = "Accueil";
			require File::build_path(["view", "view.php"]);
		}
	}
?>