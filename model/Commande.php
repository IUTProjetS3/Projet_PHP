<?php

require_once(File::build_path(array("model", "Model.php")));

class Commande extends Model
{
    private $idCommande;
    private $idLivre = [];
    private $date;
    private $idUtilisateur;
    private $montant;

    public static function addCommande($idUser){
        try {
            $sql = "INSERT INTO `projet_commande`(dateCommande`, `prixCommande`) VALUES ([value-2],[value-3])";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(":id" => $id);
            // On donne les valeurs et on exécute la requête
            $req_prep->execute($values);
            var_dump($req_prep);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
            $tab_user = $req_prep->fetchAll();
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
        if(empty($tab_user))
            return false;
        return $tab_user[0];
    }

    public static function getAllCommandes($id){
        try {
            $sql = "SELECT pa.idCommande, p.dateCommande, p.prixCommande, pa.idUtilisateur FROM projet_a_commander pa JOIN projet_commande p ON pa.idCommande=p.idCommande WHERE pa.idUtilisateur=:id";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(":id" => $id);
            // On donne les valeurs et on exécute la requête
            $req_prep->execute($values);
            var_dump($req_prep);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
            $tab_user = $req_prep->fetchAll();
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
        if(empty($tab_user))
            return false;
        return $tab_user[0];
    }
}