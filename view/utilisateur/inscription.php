<form method="post" action="index.php">
  <fieldset>
    <legend><?= $create ? 'Inscription' : 'Modifier' ?> :</legend>
    <p>
      <label for="id_prenom">Prénom</label> :
      <input type="text" placeholder="Ex : Jean" required name="prenomUtilisateur" id="id_prenom" value="<?= htmlspecialchars($data['prenom']) ?>" />
    </p>
    <p>
      <label for="id_nom">Nom</label> :
      <input type="text" placeholder="Ex : Durand" required name="nomUtilisateur" id="id_nom" value="<?= htmlspecialchars($data['nom']) ?>"/>
    </p>
    <p>
      <label for="id_mail">Mail</label> :
      <input type="email" placeholder="Ex : jean@gmail.com" <?= $create ? 'required' : 'readonly' ?> name="mailUtilisateur" id="id_mail" value="<?= htmlspecialchars($data['mail']) ?>"/>
    </p>
    <?php if($create) : ?>
    <p>
      <label for="id_mdp">Mot de passe</label> :
      <input type="password" name="mdp" required id="id_mdp"/>
    </p>
    <p>
      <label for="id_remdp">Mot de passe à nouveau</label> :
      <input type="password" name="remdp" required id="id_remdp"/>
    </p>
  <?php endif; ?>

  <?php if(!$create) :
    if(isset($data['id']))
      $idUtilisateur = $data['id'];
    else
       $idUtilisateur = $u->getAttr("idUtilisateur");

   ?>
      <input type="hidden" name='idUtilisateur' value="<?= htmlspecialchars($idUtilisateur) ?>">
      <?php if(Session::is_admin()) : 
        if(isset($data['role']))
          $role = $data['role'];
        else
           $role = $u->getAttr("role");

        ?>
    <p>
      <select name="role">
        <option <?= $role == "admin" ? "selected" : "" ?> value="admin">Admin</option>
        <option <?= $role == "acheteur" ? "selected" : "" ?> value="acheteur">Acheteur</option>
      </select>
    </p>
  <?php endif; ?>
    <?php endif; ?>


    <p>
      <input type="submit" value="Envoyer" />
    </p>
    <input type="hidden" name='action' value='<?= $create ? "inscrire" : "updated" ?>'>
    <input type="hidden" name='controller' value="utilisateur">
    
  </fieldset> 
  <?php if($create) : ?>
  <a href="index.php?action=connexion&controller=utilisateur">Connexion</a>
<?php endif; ?>
</form>
