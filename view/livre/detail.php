<div>
    <h1>Détail du livre</h1>
    <div style="float:left;">
        
        <img width="100" src="view/img/livres/<?= $livre->getAttr('image') ?>">
    </div>
    <div>
        <!-- Ou ça <?//php echo $livre->getAttr("nom"); ?>-->
        <p> Titre : <?= $livre->getAttr("nom") ?></p>
        <p> Description : </p>
        <p><?= $livre->getAttr("description") ?></p>
        <p> Prix : <?= $livre->getAttr("prix") ?> €</p>
        <p> Les avis : <?= $livre->getAttr("avis") ?></p>
    </div>
    <a href="?controller=livre&action=panier&idLivre=<?= rawurlencode($livre->getAttr('idLivre')) ?>" > 
        <input type="button" value="Ajouter au Panier">
    </a>
    
    <!-- if(Session::is_admin()){                   A faire
    			echo '<a href=index.php?action=delete&id='.rawurlencode($v->getId()).'>supprimer le produit</a> <br>';

    			echo '<a href=index.php?action=update&id='.rawurlencode($v->getId()).'>mettre à jour le produit </a> <br>'
                -->

</div>