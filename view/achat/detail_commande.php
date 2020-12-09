<?php if($commande) : ?>

        
         <p>Commande n°<?= htmlspecialchars($commande->getAttr('idCommande')) ?>: <?= htmlspecialchars($commande->getAttr('prixCommande'))?>€</p>
        <?php foreach ($commande->getAttr('idLivre') as $l) :
                	$livre = Livre::select($l["idLivre"]);
                ?>
            <p><?= htmlspecialchars($livre->getAttr('nom')) ?>: x<?= htmlspecialchars($l["quantite"]) ?></p>
<?php endforeach; ?>
        
<?php else : ?>
    <p> Aucune Commande</p>
<?php endif; ?>

