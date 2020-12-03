<?php
$tarif = 0;
foreach ($_SESSION['panier'] as $l) :
    $livre = Livre::select($l[0]);
    $tarif = $tarif + $livre->getAttr('prix')*$l[1];
    ?>
    <p><?= $livre->getAttr('nom')  ?> : <?= $l[1] ?></p>
<?php endforeach; ?>
<p>Montant Total : <?= $tarif ?> €</p>
<a href="?controller=commande&action=commander&tarif=<?= $tarif ?>" >
    Passez Commande
</a>
