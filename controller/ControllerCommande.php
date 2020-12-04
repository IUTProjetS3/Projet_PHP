<?php

require_once File::build_path(['model', 'Utilisateur.php']);
require_once File::build_path(['model', 'Commande.php']);



class ControllerCommande
{

    public static function read(){
        $commande = Commande::getCommande($_GET['idCommande']);
        $TITLE = "Détail commande";
        $controller = "achat";
        $page = "detail_commande";


        require File::build_path(["view", "view.php"]);
    }









    public static function commande(){
        $tab_c = Commande::getAllCommandes($_SESSION['projet_user_connected']->getAttr('idUtilisateur'));
        $TITLE = "Liste des Commandes";
        $controller = "achat";
        $page = "list_commande";


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
        $idCommande;
        do{
            $numbytes = 8; // Because 32 digits hexadecimal = 16 bytes
            $bytes = openssl_random_pseudo_bytes($numbytes); 
            $idCommande   = strtoupper(bin2hex($bytes));
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

    public static function viderPanier(){
        unset($_SESSION['panier']);
        header("Location:?action=panier&controller=utilisateur");
    }

}