<header>
    <a href="index.php" id="accueil" class="col-3">
        <p id="logo">
            Librairie.com
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
            <?php if(isset($_SESSION['projet_user_connected'])):?>
            <div id="commande" class="item">
                <a href="index.php?action=commande&controller=commande">Commandes</a>
            </div>
            <div id="profil" class="item">
                <a href="index.php?controller=utilisateur&action=read&idUtilisateur=<?=rawurlencode($_SESSION['projet_user_connected']->getAttr("idUtilisateur"))?>">Profil</a>
            </div>
            <div id="logout" class="item">
                <a href="index.php?action=deconnexion&controller=utilisateur">Déconnexion</a>
            </div>
                <?php else : ?>
                    <div id="login" class="item">
                         <a href="index.php?controller=utilisateur&action=connexion">Connexion</a>
                     </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>