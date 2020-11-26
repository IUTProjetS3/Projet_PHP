<h1>Bienvenue <?= isset($_SESSION['projet_user_connected']) ? htmlspecialchars($_SESSION['projet_user_connected']->getAttr('prenomUtilisateur')) : ''  ?> sur l'accueil !</h1>

<php>