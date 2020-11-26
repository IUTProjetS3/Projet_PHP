<form method="post" action="index.php" enctype="multipart/form-data">
  <fieldset>
    <legend>Ajouter un livre :</legend>
      <label for="id_nom">Nom</label> :
      <input type="text" name="nom" id="id_nom"/>
    </p>
    <p>
      <label for="id_desc">Description</label> :
      <textarea name="description" id="id_desc" cols="10" rows="10"></textarea>
    </p>
    <p>
      <label for="id_prix">Prix</label> :
      <input type="number" name="prix" id="id_prix">
    </p>
    <p>
      <label for="id_stock">Stock</label> :
      <input type="number" name="stock" id="id_stock">
    </p>
    <p>
      <label for="id_image">Image</label> :
      <input type="file" id="id_image" name="image">
    </p>

    <p>
      <input type="submit" value="Envoyer" />
    </p>
    <input type="hidden" name='action' value='created'>
    <input type="hidden" name='controller' value="livre">
  </fieldset> 
</form>