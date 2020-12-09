<header>
    <a href="index.php" id="accueil" class="col-3">
        <p id="logo">
            NOM DU PROJET
        </p>
    </a>
    <form method="post" action="index.php">
        <input type="text" id="recherche" name="recherche"  placeholder="(ex: Science-fiction, Iron Man)">
        <input type="submit" value="Rechercher">
        <input type="hidden" name="controller" value="livre">
        <input type="hidden" name="action" value="rechercher">
    </form>
    <nav id="navigation" class="col-4">
        <div id="utilisateur" class="item">
            <a href="index.php?action=readAll&controller=utilisateur">Liste utilisateurs</a>
        </div>
        <div id="panier" class="item">
            <a href="index.php?action=panier&controller=utilisateur">Panier</a>
        </div>
        <div id="profil" class="item">
            <p>Profil</p>
            <div id="nav_profil">
                <?php if(isset($_SESSION['projet_user_connected'])):?>
                    <a href="index.php?controller=utilisateur&action=read&idUtilisateur=<?=$_SESSION['projet_user_connected']->getAttr("idUtilisateur")?>">Profil</a>
                <?php else : ?>
                    <a href="index.php?controller=utilisateur&action=connexion">Connexion</a>
                <?php endif; ?>
                <a href="index.php?action=commande&controller=commande">Commandes</a>
                <?php if(isset($_SESSION['projet_user_connected'])):?>
                    <a href="index.php?action=deconnexion&controller=utilisateur">Déconnexion</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>