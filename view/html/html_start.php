<?php
/*
require_once 'Model/Model.php';
require_once 'Model/Utilisateur.php';

session_start();
*/
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <?php foreach ($CSS as $css) : ?>
        <link rel="stylesheet" type="text/css" href=<?= $css ?>>
    <?php endforeach;?>
    <?php foreach ($LIBRAIRIES as $lib) : ?>
        <script type="text/javascript" src="<?= $lib ?>"></script>
    <?php endforeach;?>
    <title><?=$TITLE?></title>
</head>

<body>