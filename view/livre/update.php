<div>
    <h1>Mofidier le livre</h1>
    <div style="float:left;">
        
        <img width="100" src="view/img/livres/<?= htmlspecialchars($livre->getAttr('image')) ?>">
    </div>
    <div>
        <form method="post" action="index.php" enctype="multipart/form-data">
          <fieldset>
              <label for="id_nom">Nom</label> :
              <input type="text" name="nom" id="id_nom" value="<?= htmlspecialchars($livre->getAttr("nom")) ?>"/>
            </p>
            <p>
              <label for="id_desc">Description</label> :
              <textarea name="description" id="id_desc" cols="10" rows="10" ><?= htmlspecialchars($livre->getAttr("description")) ?></textarea>
            </p>
            <p>
              <label for="id_prix">Prix</label> :
              <input type="number" name="prix" id="id_prix" value="<?= htmlspecialchars($livre->getAttr("prix")) ?>">€
            </p>
            <p>
              <label for="id_stock">Stock</label> :
              <input type="number" name="stock" id="id_stock" value="<?= htmlspecialchars($livre->getAttr("stock")) ?>">
            </p>

            <p>
              <input type="submit" value="Envoyer" />
            </p>
            <input type="hidden" name="idLivre" value="<?= htmlspecialchars($_GET['idLivre']) ?>">


            <input type="hidden" name='action' value='updated'>
            <input type="hidden" name='controller' value="livre">
          </fieldset> 
         </form>
    </div>
</div>

<a href="index.php">Retour à l'Accueil</a>