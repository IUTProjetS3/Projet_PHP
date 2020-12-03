<?php


class ControllerCommande
{
    public static function commande(){
        $TITLE = "Commande";
        $controller = "achat";
        $page = "commande";
        $commandes = ["Pas de commandes"];

        require File::build_path(["view", "view.php"]);
    }

    public static function commander(){



        self::commande();
    }

}