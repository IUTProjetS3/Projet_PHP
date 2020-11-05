<?php
require_once(File::build_path(array("model", "ModelVoiture.php")));
class ControllerVoiture {
    public static function readAll() {
        $tab_v = ModelVoiture::getAllVoitures(); //appel au modèle pour gerer la BD
        require(File::build_path(array("view", "voiture", "list.php")));
        //require ('../view/voiture/list.php');  //"redirige" vers la vue
    }

    public static function read(){
    	$immat = $_GET['immatriculation'];
    	$v = ModelVoiture::getVoitureByImmat($immat);

    	if (!$v) {
            require(File::build_path(array("view", "voiture", "error.php")));
    		//require('../view/voiture/error.php');
    	}
    	else{
            require(File::build_path(array("view", "voiture", "detail.php")));
    		//require('../view/voiture/detail.php');
    	}
    }

    public static function create(){
        require(File::build_path(array("view", "voiture", "create.php")));
    	//require('../view/voiture/create.php');
    }

    public static function created(){
        $marque = $_GET['marque'];
        $couleur = $_GET['couleur'];
        $immatriculation = $_GET['immatriculation'];
       
        $v = new ModelVoiture($marque, $couleur, $immatriculation);
        
        $savesuccess = $v->save();
        if ($savesuccess) {
            self::readAll();
        }
        else{
            require(File::build_path(array("view", "voiture", "error.php")));
            //require('../view/voiture/error.php');
        }
    }
}
?>

