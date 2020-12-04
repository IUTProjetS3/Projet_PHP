<?php if($commande) : ?>

        
         <p>Commande n°<?= $commande->getAttr('idCommande') ?>: <?=$commande->getAttr('prixCommande')?>€</p>
        <?php foreach ($commande->getAttr('idLivre') as $l) :
                	$livre = Livre::select($l["idLivre"]);
                ?>
            <p><?= $livre->getAttr('nom') ?>: x<?= $l["quantite"] ?></p>
<?php endforeach; ?>
        
<?php else : ?>
    <p> "Aucune Commande"</p>
<?php endif; ?>

