<form method="post" action="index.php">
  <fieldset>
    <legend>Connexion :</legend>
      <label for="id_mail">Mail</label> :
      <input type="email" placeholder="Ex : jean@gmail.com" name="mail" id="id_mail" value="<?= htmlspecialchars($data['mail']) ?>" />
    </p>
    <p>
      <label for="id_mdp">Mot de passe</label> :
      <input type="password" name="mdp" id="id_mdp"/>
    </p>
    <p>
      <input type="submit" value="Envoyer" />
    </p>
    <input type="hidden" name='action' value='connecte'>
    <input type="hidden" name='controller' value="utilisateur">
  </fieldset> 
  <a href="index.php?action=inscription&controller=utilisateur">Inscription</a>
</form>