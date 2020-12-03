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
        $id = random_bytes(888);
        if (!isset($_GET)) {
            var_dump("noice");
        }
        else {
            var_dump("po noice");
        }
        if (!isset($_SESSION)) {
            session_start();
        }
        if(!isset($_SESSION['commande'])) {
            $_SESSION['commande'] = [$id,$_SESSION['panier'],];
        }
        else {
            var_dump("coucou");
            $exist = false;
            $i = 0;
            foreach ($_SESSION['panier'] as $l) {
                if ($idlivre==$l[0]) {
                    $_SESSION['panier'][$i][1]=$_SESSION['panier'][$i][1]+$quantite;
                    //$l[1] = $l[1]+$quantite;
                    $exist = true;
                    var_dump("ce livre est deja dans le panier");
                    var_dump("ajoute une quantite");
                }
                $i++;
            }
            if (!$exist) {
                var_dump("ajoute un livre");
                array_push($_SESSION['panier'], [$idlivre, $quantite]);
            }
        }

        self::commande();
    }

}