<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <?php foreach ($CSS as $css) : ?>
        <link rel="stylesheet" type="text/css" href="<?= $css ?>">
    <?php endforeach;?>
    <?php foreach ($LIBRAIRIES as $lib) : ?>
        <script type="text/javascript" src="<?= $lib ?>"></script>
    <?php endforeach;?>
    <title><?=$TITLE?></title>
</head>

<body>