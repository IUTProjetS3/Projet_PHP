<?php


class ControllerCommande
{
    public static function commande(){
        $TITLE = "Commandes";
        $controller = "achat";
        $page = "commandes";

        require File::build_path(["view", "view.php"]);
    }

    public static function commander(){
        if (!isset($_SESSION)){
            var_dump("ya pas de session");
        }
        if (!isset($_SESSION['panier'])){
            var_dump("ya pas de panier");
        }
        if (empty($_SESSION['panier'])){
            var_dump("ya rien dans ton panier");
        }
        $id=1;
        $tarif=0;
        foreach ($_SESSION['panier'] as $l) {
            $tarif= $tarif+Livre::select($l[0])->getAttr('prix')*$l[1];
        }
        if(!isset($_SESSION['commande'])) {
            $_SESSION['commande'] = [$id,$_SESSION['panier'],$tarif];
        }
        else {
            array_push($_SESSION['commande'], [$id, $_SESSION['panier'], $tarif]);
        }
        self::commande();
    }

}