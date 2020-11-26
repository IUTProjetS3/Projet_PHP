<?php

require_once(File::build_path(array("controller", "ControllerUtilisateur.php")));
require_once(File::build_path(array("controller", "ControllerAccueil.php")));
session_start();

$action = 'accueil';
if(isset($_GET['action'])){
	if(!empty($_GET['action']))
		$action = $_GET['action'];
}else if(isset($_POST['action'])){
	if(!empty($_POST['action']))
		$action = $_POST['action'];
}

$controller = 'accueil';
if(isset($_GET['controller'])){
	if(!empty($_GET['controller']))
		$controller = $_GET['controller'];
}else if(isset($_POST['controller'])){
	if(!empty($_POST['controller']))
		$controller = $_POST['controller'];
}

$controller_class = "Controller".ucfirst($controller);

if(class_exists($controller_class)){
	if(in_array($action, get_class_methods($controller_class))){
		$controller_class::$action(); 
	}else{
		$erreur = "Erreur lors du traitement !";
		$controller_class::error($erreur);
	}
}else{
		$erreur = "Erreur lors du traitement !";
		ControllerAccueil::error($erreur);
	}
?>