<?php

require_once File::build_path(['model', 'Utilisateur.php']);
require_once File::build_path(['model', 'Commande.php']);



class ControllerCommande
{

    public static function read(){
        if(isset($_SESSION['projet_user_connected'])){
            $commande = Commande::getCommande($_GET['idCommande']);
            $TITLE = "Détail commande";
            $controller = "achat";
            $page = "detail_commande";
            require File::build_path(["view", "view.php"]);
        }else{
            $TITLE = "erreur";
            $controller = "utilisateur";
            $page = "connexion";
            $erreur="Vous devez etre connecté";
            $data["mail"]="";
            require File::build_path(["view", "view.php"]);
        }
    }



    public static function commande(){
        if(isset($_SESSION['projet_user_connected'])){
            $tab_c = Commande::getAllCommandes($_SESSION['projet_user_connected']->getAttr('idUtilisateur'));
            $TITLE = "Liste des Commandes";
            $controller = "achat";
            $page = "list_commande";
            require File::build_path(["view", "view.php"]);

        }else{
            $TITLE = "erreur";
            $controller = "utilisateur";
            $page = "connexion";
            $erreur="Vous devez etre connecté";
            $data["mail"]="";
            require File::build_path(["view", "view.php"]);
        
    }
}

    public static function commander(){
        if(isset($_SESSION['projet_user_connected'])){
                if (!isset($_SESSION)){
                    var_dump("Problème, nous vous invitons à recharger le site");
                }
                if (!isset($_SESSION['panier'])){
                    var_dump("Problème, nous vous invitons à recharger le site");
                }
                if (empty($_SESSION['panier'])){
                    var_dump("Panier Vide");
                }
                if (!isset($_SESSION['projet_user_connected'])){
                    header("Location:?controller=utilisateur&action=connexion");
                }
                else {
                    $idCommande;
                    do{
                        $idCommande   = strtoupper(Security::getRandomHex(8));
                    }while(!Commande::createCommande($idCommande));
                    Commande::linkUser($idCommande, $_SESSION['projet_user_connected']->getAttr('idUtilisateur'));


                    $tarif=0;
                    foreach ($_SESSION['panier'] as $l) {
                        $livre = Livre::select($l[0]);
                        Commande::addLivre($livre->getAttr('idLivre'), $idCommande, $l[1]);
                        Livre::update(['idLivre' => $livre->getAttr('idLivre'), 'stock' => ($livre->getAttr('stock')-$l[1])]);
                        $tarif= $tarif+$livre->getAttr('prix')*$l[1];
                    }

                    Commande::update(['idCommande' => $idCommande, 'prixCommande' => $tarif]);
                    unset($_SESSION['panier']);


                    header("Location:?controller=commande&action=commande");
                }
            }else{
                $TITLE = "erreur";
                $controller = "utilisateur";
                $page = "connexion";
                $erreur="Vous devez etre connecté";
                $data["mail"]="";
                require File::build_path(["view", "view.php"]); 
            }
    }

    public static function viderPanier(){
        unset($_SESSION['panier']);
        header("Location:?action=panier&controller=utilisateur");
    }

}