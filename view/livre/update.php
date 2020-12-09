<div>
    <h1><?= !$create ? 'Mofidier' : 'Créer' ?> le livre</h1>
    <?php if(!$create) : ?>
    <div style="float:left;">
        
<?php if($livre->getAttr('image') != "" && $livre->getAttr('image') != NULL) : ?>
                <img alt="livre" width="100" src="view/img/livres/<?= htmlspecialchars($livre->getAttr('image')) ?>">
            <?php endif; ?>    
          </div> 
  <?php endif; ?>
    <div>
        <form method="post" action="index.php" enctype="multipart/form-data">
          <fieldset>
              <label for="id_nom">Nom</label> :
              <input type="text" name="nom" id="id_nom" required value="<?= htmlspecialchars($livre->getAttr("nom")) ?>"/>
            </p>
            <p>
              <label for="id_desc">Description</label> :
              <textarea name="description" id="id_desc" cols="10" rows="10" required ><?= htmlspecialchars($livre->getAttr("description")) ?></textarea>
            </p>
            <p>
              <label for="id_prix">Prix</label> :
              <input type="number" name="prix" step="0.01" id="id_prix" required value="<?= htmlspecialchars($livre->getAttr("prix")) ?>">€
            </p>
            <p>
              <label for="id_stock">Stock</label> :
              <input type="number" name="stock" id="id_stock" required value="<?= htmlspecialchars($livre->getAttr("stock")) ?>">
            </p>

            <p>
              <label for="id_categorie">Catégorie</label> :
              <select name="categorie" required id="id_categorie">
                <?php foreach($categories as $cat) : ?>
                  <option value="<?= htmlspecialchars($cat->getAttr('idCategorie')) ?>" <?= $livre->getAttr('categorie')->getAttr('idCategorie') == $cat->getAttr('idCategorie') ? 'selected' : '' ?>><?= htmlspecialchars($cat->getAttr('nom')) ?></option>
                <?php endforeach; ?>
              </select>
            </p>

            <p>
              <input type="submit" value="Envoyer" />
            </p>
            <?php if(!$create) : ?>
              <input type="hidden" name="idLivre" value="<?= htmlspecialchars($_GET['idLivre']) ?>">
            <?php endif; ?>

            <input type="hidden" name='action' value="<?= $create ? 'created' : 'updated' ?>">
            <input type="hidden" name='controller' value="livre">
          </fieldset> 
         </form>
    </div>
</div>

<a href="index.php">Retour à l'Accueil</a>