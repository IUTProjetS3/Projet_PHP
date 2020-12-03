<?php

require_once File::build_path(['model', 'Livre.php']);

class ControllerLivre {


	//Il faut ajouter deleted et update et error


	public static function readAll(){

		$tab_l = Livre::selectAll();
		$page = "list";
		$controller = "livre";
		$TITLE = "Accueil";
		
		require File::build_path(['view', "view.php"]);
	}

	public static function read(){
		$TITLE = "Livre numero";
		$controller = "livre";
		$page = "detail";
		$idlivre = $_GET['idLivre'];
		$livre = Livre::select($idlivre);

		require File::build_path(["view", "view.php"]);
	}	

	public static function panier(){ //Début à finir
		$idlivre = $_GET['idLivre'];
		$quantite = 1;
        if (!isset($_SESSION)) {
            session_start();
        }
        if(!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [[$idlivre, $quantite]];
        }
        else {
            $exist = false;
            $i = 0;
            foreach ($_SESSION['panier'] as $l) {
                if ($idlivre==$l[0]) {
                    $_SESSION['panier'][$i][1]=$_SESSION['panier'][$i][1]+$quantite;
                    //$l[1] = $l[1]+$quantite;
                    $exist = true;
                }
                $i++;
            }
            if (!$exist) {
                array_push($_SESSION['panier'], [$idlivre, $quantite]);
            }
        }
	
		$controller='livre'; 
		$page='detail'; 
		$TITLE='livre';

		require File::build_path(["view", "view.php"]);  //"redirige" vers la vue
	}

	// A finir mais obligatoire
	public static function error(){
		$TITLE = "erreur";
		$controller = "livre";
		$page = "error";
	
		require File::build_path(["view", "view.php"]);
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