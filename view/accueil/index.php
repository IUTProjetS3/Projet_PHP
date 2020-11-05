<h1>Bienvenue <?= isset($_SESSION['projet_user_connected']) ? htmlspecialchars($_SESSION['projet_user_connected']->getAttr('prenomUtilisateur')) : ''  ?> sur l'accueil !</h1>
<?php if(isset($_SESSION['projet_user_connected'])) : ?>
	<a href="index.php?action=deconnexion&controller=utilisateur">Déconnexion</a>
<?php else : ?>
	<a href="index.php?action=connexion&controller=utilisateur">Connexion</a>
<?php endif; ?>