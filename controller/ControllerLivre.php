<?php

require_once File::build_path(['model', 'Livre.php']);

class ControllerLivre {



	public static function readAll(){

		$tab_l = Livre::selectAll();
		$page = "list";
		$controller = "livre";
		$TITLE = "Liste des livres";
		
		require File::build_path(['view', "view.php"]);
	}

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
				$TITLE = "Liste des livres";
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