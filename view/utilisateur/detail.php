<div>
    <p><?= htmlspecialchars($profil->getAttr('prenomUtilisateur')) ?></p>
    <p><?= htmlspecialchars($profil->getAttr('nomUtilisateur')) ?></p>
    <p><?= htmlspecialchars($profil->getAttr('mailUtilisateur')) ?></p>
    <p><?= htmlspecialchars($profil->getAttr('role')) ?></p>
    <?php if(isset($_SESSION['projet_user_connected']) && ($profil->getAttr('idUtilisateur')==$_SESSION['projet_user_connected']->getAttr('idUtilisateur') || Session::is_admin())): ?>
    	<a href="index.php?controller=utilisateur&action=modifierprofil&idUtilisateur=<?= rawurlencode($profil->getAttr('idUtilisateur')) ?>">Modifier Profil</a>
    	<a href="index.php?controller=utilisateur&action=delete&idUtilisateur=<?= rawurlencode($profil->getAttr('idUtilisateur')) ?>">Supprimer Profil</a>
    <?php endif; ?>
</div>