<div>
    <p><?= htmlspecialchars($profil->getAttr('prenomUtilisateur')) ?></p>
    <p><?= htmlspecialchars($profil->getAttr('nomUtilisateur')) ?></p>
    <p><?= htmlspecialchars($profil->getAttr('mailUtilisateur')) ?></p>
    <p><?= htmlspecialchars($profil->getAttr('role')) ?></p>
    <?php if($profil->getAttr('idUtilisateur')==$_SESSION['projet_user_connected']->getAttr('idUtilisateur')): ?>
    	<a href="index.php?controller=utilisateur&action=modifierprofil">Modifier Profil</a>
    <?php endif; ?>
</div>