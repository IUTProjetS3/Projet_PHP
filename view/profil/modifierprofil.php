<div>


    <form>
        <input type="text" value="<?= $_SESSION['projet_user_connected']->getAttr('prenomUtilisateur') ?>">
        <input type="text" value="<?= $_SESSION['projet_user_connected']->getAttr('nomUtilisateur') ?>">
        <input type="text" value="<?= $_SESSION['projet_user_connected']->getAttr('mailUtilisateur') ?>">
    </form>


    <button>Enregistrer</button>
</div>