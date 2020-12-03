<?php
var_dump($_SESSION['commande']);
if (isset($_SESSION['commande'])) {
    if (empty($_SESSION['commande'])) {
        echo "Aucune Commande";
    }
    else {
        foreach ($_SESSION['commande'] as $p) :?>
            <p>Commande n°<?= $p[0] ?>: <?=$p[2]?>€</p>
        <?php foreach ($p[1] as $l) :
                $livre = Livre::select($l[0])
                ?>
            <p><?= $livre->getAttr('nom') ?>: x<?= $l[1] ?></p>
<?php endforeach;
        endforeach;
    }
}
else {
    echo "Aucune Commande";
}

?>