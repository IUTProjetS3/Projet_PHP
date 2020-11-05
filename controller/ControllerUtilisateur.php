<?php
	require_once File::build_path(['model', 'Utilisateur.php']);
	/**
	 * 
	 */
	class ControllerUtilisateur
	{
		
		public static function inscription(){
			$controller = "utilisateur";
			$page = "inscription";

			require File::build_path(["view", "view.php"]);
		}
	}
?>