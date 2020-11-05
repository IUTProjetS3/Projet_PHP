<form method="post" action="index.php">
  <fieldset>
    <legend>Mon formulaire :</legend>
    <p>
      <label for="id_prenom">Prénom</label> :
      <input type="text" placeholder="Ex : Jean" name="prenom" id="id_prenom"/>
    </p>
    <p>
      <label for="id_nom">Nom</label> :
      <input type="text" placeholder="Ex : Durand" name="nom" id="id_nom"/>
    </p>
    <p>
      <label for="id_mail">Mail</label> :
      <input type="email" placeholder="Ex : jean@gmail.com" name="mail" id="id_mail"/>
    </p>
    <p>
      <label for="id_mdp">Mot de passe</label> :
      <input type="password" name="mdp" id="id_mdp"/>
    </p>
    <p>
      <label for="id_remdp">Mot de passe à nouveau</label> :
      <input type="password" name="remdp" id="id_remdp"/>
    </p>
    <p>
      <input type="submit" value="Envoyer" />
    </p>
    <input type="hidden" name='action' value='inscrire'>

  </fieldset> 
</form>
