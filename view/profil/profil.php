<div>
    <p><?= $profil->getAttr('prenomUtilisateur') ?></p>
    <p><?= $profil->getAttr('nomUtilisateur') ?></p>
    <p><?= $profil->getAttr('mailUtilisateur') ?></p>
    <p><?= $profil->getAttr('role') ?></p>
    <?php if($profil->getAttr('idUtilisateur')==$_SESSION['projet_user_connected']->getAttr('idUtilisateur')): ?>
    <a href="index.php?controller=utilisateur&action=modifierprofil">Modifier Profil</a>
    <?php endif; ?>
</div>