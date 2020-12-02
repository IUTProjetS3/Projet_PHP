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

	private static function read(){
		$TITLE = "Livre numero";
		$controller = "livre";
		$page = "detail";
		$idlivre = $_GET['idlivre'];
		$livre = Livre::select($idlivre);

		require File::build_path(["view", "view.php"]);
	}	

	// voir si c'est utile
	private static function error(){
		$TITLE = "erreur";
		$controller = "livre";
		$page = "error";
	
		require File::build_path(["view", "view.php"]);
	}	

		/*
			$idprofil = $_GET['idlivre'];
			$idlibre = Livre::select($idlivre);
			//$tab_l = Livre::getAttr(myGet('idLivre'))
			$page = "detail";
			$controller = "livre";
			$TITLE = "nom du livre";

			if (!$idlibre) {
				require(File::build_path(array("view", "livre", "error.php")));
				
			}
			else{
				require(File::build_path(array("view", "livre", "detail.php")));
				
			} */
			
		//}

	public static function create(){
		$page = "create";
		$controller = "livre";
		$TITLE = "Ajouter un livre";
		require File::build_path(["view", "view.php"]);
	}

	public static function created(){
		if(isset($_POST)){
			$data = [
				"nom" => $_POST['nom'],
				"description" => $_POST['description'],
				"prix" => $_POST['prix'],
				"stock" => $_POST['stock'],
				"image" => self::createImage($_FILES['image'])
			];
			$create = Livre::save($data);

			if($create){

				$tab_l = Livre::selectAll();
				$page = "created";
				$controller = "livre";
				$TITLE = "Livre créé";
				require File::build_path(['view', 'view.php']);
			}
		}
	}

	private static function createImage($image){
		$tmpFilePath = $image['tmp_name'];
		if ($tmpFilePath != ""){
			$hashName = hash('sha256', $image['name'].rand());
			$newFilePath = File::build_path(['view', 'img', 'livres']);
			$extension = explode('.', $image['name'])[1];
			if(!file_exists($newFilePath)) {
				mkdir($newFilePath, 0777, true);
			}
			move_uploaded_file($tmpFilePath, $newFilePath."/".$hashName.".".$extension);
			return $hashName.".".$extension;
	}
	return "";
}

}