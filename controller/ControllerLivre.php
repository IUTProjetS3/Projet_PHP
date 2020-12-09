<?php

require_once File::build_path(['model', 'Livre.php']);
require_once File::build_path(['lib', 'Security.php']);

class ControllerLivre extends Controller {


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
		$livre->getCategorie();
		require File::build_path(["view", "view.php"]);
	}	

	public static function delete(){
        if(Session::is_admin()){
			$idlivre = $_GET['idLivre'];
			Livre::delete($idlivre);
			$tab_l = Livre::selectAll();
			$controller='livre'; 
			$page='deleted'; 
			$TITLE='supprimé';     //appel au modèle pour gerer la BD
			require File::build_path(['view', "view.php"]);
        }
        else{
			$tab_l = Livre::selectAll();
			$page = "list";
			$controller = "livre";
			$TITLE = "Accueil";
			require File::build_path(['view', "view.php"]);
        }
	}
	
	public static function update(){ 
        if(Session::is_admin()){
			$TITLE = "Modifier Livre";
			$controller = "livre";
			$page = "update";
			$create = false;
			$idlivre = $_GET['idLivre'];
			$livre = Livre::select($idlivre);
			$livre->getCategorie();
			$categories = Categorie::selectAll();
			require File::build_path(["view", "view.php"]);
        }
        else{
			$tab_l = Livre::selectAll();
			$page = "list";
			$controller = "livre";
			$TITLE = "Accueil";
			require File::build_path(['view', "view.php"]);
        }
	}
	
	public static function updated(){ //A finir 
        if(Session::is_admin()){
        	if($_POST["nom"] != "" && $_POST['description'] != "" && $_POST['prix'] != "" && $_POST['stock'] != "" && $_POST['idLivre'] != ""){
        		//A envoyer à la fonction le tableau et un tableau des clés qu'on ne veut pas enregistrer
        		Livre::update($_POST, ['action', 'controller', 'categorie']);
        		Livre::setCategorie($_POST['idLivre'], $_POST['categorie']);
        		$page = "updated";
        		$controller = "livre";
        		$TITLE = "Livre modifié";
        		require File::build_path(['view', 'view.php']);
        	}else{
        		$erreur = "Remplir tous les champs";
        		$TITLE = "Modifier Livre";
				$controller = "livre";
				$page = "update";
				$create = false;
				$livre = new Livre();
				$livre->setAttr("idLivre", $_POST['idLivre	']);
				$livre->setAttr("nom", $_POST['nom']);
				$livre->setAttr("description", $_POST['description']);
				$livre->setAttr("prix", $_POST['prix']);
				$livre->setAttr("stock", $_POST['stock']);
				$livre->setAttr("categorie", Categorie::select($_POST['categorie']));
				$categories = Categorie::selectAll();
				require File::build_path(["view", "view.php"]);
        	}
        }
        else{
            $tab_l = Livre::selectAll();
			$page = "list";
			$controller = "livre";
			$TITLE = "Accueil";
			require File::build_path(['view', "view.php"]);       
        }
    }

	public static function panier(){ 
		$idlivre = $_POST['idLivre'];
		$quantite = intval($_POST['quantite']);
		$livre = Livre::select($idlivre);
		if((intval($livre->getAttr("stock"))-$quantite) >= 0){
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
			$livre->getCategorie();
			$controller='livre'; 
			$page='detail'; 
			$TITLE='livre';

			require File::build_path(["view", "view.php"]);  //"redirige" vers la vue
		}else{
			//self::error("?controller=livre&action=read&idLivre=".rawurlencode($livre->getAttr('idLivre')), "Quantité trop élévée");
			$erreur = "Quantité trop élévée";
			$controller = "livre";
			$page = "detail";
			$TITLE = "erreur";
			require File::build_path(["view", "view.php"]);
		}
	}




	public static function create(){
		if(Session::is_admin()){
			$categories = Categorie::selectAll();
			$page = "update";
			$controller = "livre";
			$create = true;
			$livre = new Livre(["nom" => "", "description" => "", "prix" => ""]);
			$livre->setAttr("categorie", new Categorie(['idCategorie' => -1, 'nom' => 'Catégorie...']));
			$TITLE = "Ajouter un livre";
			require File::build_path(["view", "view.php"]);
		}else{
			$tab_l = Livre::selectAll();
			$page = "list";
			$controller = "livre";
			$TITLE = "Accueil";
			require File::build_path(['view', "view.php"]);   
		}
	}

	public static function created(){
		if(Session::is_admin()){
			if($_POST["nom"] != "" && $_POST['description'] != "" && $_POST['prix'] != "" && $_POST['stock'] != ""){
				
				$idLivre;
				$data["image"] = self::createImage($_FILES['image']);
				do{
					$idLivre = strtoupper(Security::getRandomHex(8));
					$data = $_POST;
					$data['idLivre'] = $idLivre;


				}while(!Livre::createLivre($data, ['action', 'controller', 'categorie']));

				
					
				Livre::linkCategorie($idLivre, $_POST['categorie']);
					

					$tab_l = Livre::selectAll();
					$page = "created";
					$controller = "livre";
					$TITLE = "Livre créé";
					require File::build_path(['view', 'view.php']);
				
			}else{
				$erreur = "Remplir tous les champs";
				$categories = Categorie::selectAll();
				$page = "update";
				$controller = "livre";
				$create = true;
				$livre = new Livre();
				$livre->setAttr("nom", $_POST['nom']);
				$livre->setAttr("description", $_POST['description']);
				$livre->setAttr("prix", $_POST['prix']);
				$livre->setAttr("stock", $_POST['stock']);
				$livre->setAttr("categorie", Categorie::select($_POST['categorie']));
				$TITLE = "Ajouter un livre";
				require File::build_path(["view", "view.php"]);
			}
		}else{
			$tab_l = Livre::selectAll();
			$page = "list";
			$controller = "livre";
			$TITLE = "Accueil";
			require File::build_path(['view', "view.php"]);   
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


	public static function rechercher(){
		if(isset($_POST)){
			$livres = Livre::selectFromSearch($_POST['recherche']);
			$categories = Categorie::selectFromSearch($_POST['recherche']);

			$page = 'recherche';
			$controller = "livre";
			$TITLE = "Recherche";
			require File::build_path(['view', 'view.php']);

		}
	}

	public static function readAllFromCat(){
		if(isset($_GET['idCategorie']) && $_GET['idCategorie'] > 0){
			$categorie = Categorie::select($_GET['idCategorie']);
			$tab_l = Livre::selectFromCat($categorie->getAttr('idCategorie'));
			
			$page = 'listByCat';
			$controller = 'livre';
			$TITLE = 'Livres';
			require File::build_path(['view', 'view.php']);

		}
	}

}