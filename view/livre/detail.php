<div>
    <h1>Détail du livre</h1>
    <div style="float:left;">
        
      <?php if($livre->getAttr('image') != "" && $livre->getAttr('image') != NULL) : ?>
                <img alt="livre" width="100" src="view/img/livres/<?= htmlspecialchars($livre->getAttr('image')) ?>">
            <?php endif; ?>    </div>
    <div>
        <!-- Ou ça <?//php echo $livre->getAttr("nom"); ?>-->
        <p> Titre : <?= htmlspecialchars($livre->getAttr("nom")) ?></p>
        <p> Description : </p>
        <p><?= htmlspecialchars($livre->getAttr("description")) ?></p>
        <p> Prix : <?= htmlspecialchars($livre->getAttr("prix")) ?> €</p>
        <p> Les avis : <?= htmlspecialchars($livre->getAttr("avis")) ?></p>
        <p> Catégorie :
            <?php if($livre->getAttr('categorie')->getAttr('idCategorie') == -1): ?>
                <span>Aucune</span>
            <?php else : ?>
         <a href="?action=readAllFromCat&controller=livre&idCategorie=<?= rawurlencode($livre->getAttr('categorie')->getAttr('idCategorie'))?>"><?=htmlspecialchars($livre->getAttr('categorie')->getAttr('nom')) ?></a>
     <?php endif; ?>
     </p>
    </div>

    <form method="post" action="index.php">
    <?php if($livre->getAttr('stock') == 0) : ?>
        <input disabled type="button" value="Ajouter au Panier">
    <?php else : ?>
        <input type="submit" value="Ajouter au Panier">
        <span>Quantité : </span><input type="number" name="quantite" min="1" max="<?= htmlspecialchars($livre->getAttr('stock')) ?>" value="1">
        <input type="hidden" name="controller" value="livre">
        <input type="hidden" name="action" value="panier">
        <input type="hidden" name="idLivre" value="<?= htmlspecialchars($livre->getAttr('idLivre')) ?>">

    <?php endif; ?>
    
    <?php if(Session::is_admin()) : ?>
        <br>
        <br>
        <a href="?controller=livre&action=delete&idLivre=<?= rawurlencode($livre->getAttr('idLivre')) ?>">Supprimer le produit</a>
        <br>
        <a href="?controller=livre&action=update&idLivre=<?= rawurlencode($livre->getAttr('idLivre')) ?>">Modifier le produit</a>
	<?php endif; ?>

</div>