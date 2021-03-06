<?php

require_once(File::build_path(array("controller", "Controller.php")));

require_once(File::build_path(array("controller", "ControllerUtilisateur.php")));

require_once(File::build_path(array("controller", "ControllerAccueil.php")));

require_once(File::build_path(array("controller", "ControllerLivre.php")));

require_once(File::build_path(array("controller", "ControllerCommande.php")));

require_once(File::build_path(array("lib", "Session.php")));


session_start();

$action = 'readAll';
if(isset($_GET['action'])){
	if(!empty($_GET['action']))
		$action = $_GET['action'];
}else if(isset($_POST['action'])){
	if(!empty($_POST['action']))
		$action = $_POST['action'];
}

$controller = 'livre';
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
		$controller_class::error();
	}
}else{
		ControllerAccueil::error();
	}

?>