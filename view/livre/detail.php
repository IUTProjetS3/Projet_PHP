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
        <p> Prix : <?= $livre->getAttr("prix") ?></p>
        <p> Les avis : <?= $livre->getAttr("avis") ?></p>
    </div>
    <button>Ajouter au Panier</button>

</div>