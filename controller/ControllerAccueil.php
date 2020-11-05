<?php
	
	/**
	 * 
	 */
	class ControllerAccueil
	{
		
		public static function accueil(){
			$controller = "accueil";
			$page = "index";

			require File::build_path(["view", "view.php"]);
		}
	}
?>