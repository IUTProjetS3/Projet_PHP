<?php
$tarif = 0;
if (isset($_SESSION['panier'])) {
    if (empty($_SESSION['panier'])) {
        echo "Rien dans le panier";
    }
    else {
        foreach ($_SESSION['panier'] as $l) :
            $livre = Livre::select($l[0]);
            $tarif = $tarif + htmlspecialchars($livre->getAttr('prix'))*$l[1];
            ?>
            <p><?= htmlspecialchars($livre->getAttr('nom')) ?> : <?= htmlspecialchars($l[1]) ?></p>
        <?php endforeach;?>
        <p>Montant Total : <?= $tarif ?> €</p>
        <a href="?controller=commande&action=commander">
            Passez Commande
        </a>
        <a href="?controller=commande&action=viderPanier">Vider le Panier</a>
<?php
    }
}
else {
    echo "Rien dans le panier";
}

?>