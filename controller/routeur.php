<?php

require_once(File::build_path(array("controller", "ControllerUtilisateur.php")));
$action = $_GET['action'];
ControllerUtilisateur::$action();
?>