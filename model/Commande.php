<?php

require_once(File::build_path(array("model", "Model.php")));

class Commande extends Model
{
    private $idCommande;
    private $idLivre = [];
    private $date;
    private $idUtilisateur;
    private $montant;

    public static function addCommande($tarif, $idUser){
        // AJOUTER UNE COMMANDE A PROJET_COMMANDE / PROJET_A_COMMANDER / PROJET_EST_COMMANDER
    }

    public static function getAllCommandes($id){
        // RECUPERER >TOUTES LES COMMANDES => SI VIDE = retourne ["Pas de commandes"]
    }
}