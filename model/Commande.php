<?php

require_once(File::build_path(array("model", "Model.php")));

class Commande extends Model
{
    private $idCommande;
    private $idLivre = [];
    private $dateCommande;
    private $idUtilisateur;
    private $prixCommande;

    protected static $object = "commande";
    protected static $primary = "idCommande";

    public function __construct($data = NULL){
    if (!is_null($data)){
      foreach ($data as $key => $value) {
        $this->key = value;
      }
    }
  } 

  // SETTER      
  public function setAttr($attr, $value){
            $this->$attr = $value;
        }
  // GETTER
   public function getAttr($attr){
            return $this->$attr;
        }


    public static function getAllCommandes($idUser){
        // RECUPERER >TOUTES LES COMMANDES => SI VIDE = retourne []
         try{

        $q = Model::$pdo->prepare("SELECT * FROM projet_commande pc JOIN projet_a_commander pac ON pc.idCommande=pac.idCommande WHERE idUtilisateur=:idUser ORDER BY dateCommande DESC");
        $q->execute([':idUser' => $idUser]);
        $q->setFetchMode(PDO::FETCH_CLASS, "Commande");
        $tab_c = $q->fetchAll();

      }catch(PDOException $e){
        if(Conf::getDebug()){
          echo $e->getMessage();
        }else {
           echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        } 
    }

    if(empty($tab_c))
            return false;
        return $tab_c;


    }



    public static function getCommande($idCommande){
        // RECUPERER >TOUTES LES COMMANDES => SI VIDE = retourne []
         try{

        $q = Model::$pdo->prepare("SELECT * FROM projet_commande pc JOIN projet_a_commander pac ON pc.idCommande=pac.idCommande WHERE pc.idCommande=:idCo");
        $q->execute([':idCo' => $idCommande]);
        $q->setFetchMode(PDO::FETCH_CLASS, "Commande");
        $tab_c = $q->fetchAll();

      }catch(PDOException $e){
        if(Conf::getDebug()){
          echo $e->getMessage();
        }else {
           echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        } 
    }

    if(empty($tab_c))
        return false;
    $tab_c[0]->getLivres();
    return $tab_c[0];


    }

    private function getLivres(){
        try{

        $q = Model::$pdo->prepare("SELECT idLivre, quantite FROM projet_est_commander pec JOIN projet_commande pc ON pec.idCommande=pc.idCommande WHERE pc.idCommande=:idCo");
        $q->execute([':idCo' => $this->idCommande]);
        $tab_l = $q->fetchAll();

      }catch(PDOException $e){
        if(Conf::getDebug()){
          echo $e->getMessage();
        }else {
           echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        } 
    }

    if(empty($tab_l))
        return false;
    $this->idLivre = $tab_l;
    }

    public static function createCommande($id){
        try{

        $q = Model::$pdo->prepare("SELECT * FROM projet_commande WHERE idCommande=:id");
        $q->execute([':id' => $id]);
        $tab_c = $q->fetchAll();
      }catch(PDOException $e){
        if(Conf::getDebug()){
          echo $e->getMessage();
        }else {
           echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        }
    }

    if(!empty($tab_c))
        return false;
    self::save(['idCommande' => $id]);
    return true;
    }

    public static function linkUser($idCommande, $idUser){
        try{

        $q = Model::$pdo->prepare("INSERT INTO projet_a_commander(idUtilisateur, idCommande) values(:idU, :idC)");
        $q->execute([':idU' => $idUser, ":idC" => $idCommande]);
        
      }catch(PDOException $e){
        if(Conf::getDebug()){
          echo $e->getMessage();
        }else {
           echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        }
    }
    }

    public static function addLivre($idLivre, $idCommande, $quantite){
        try{

        $q = Model::$pdo->prepare("INSERT INTO projet_est_commander(idCommande, idLivre, quantite) values(:idC, :idL, :quantite)");
        $q->execute([':idL' => $idLivre, ":idC" => $idCommande, ":quantite" => $quantite]);
        
      }catch(PDOException $e){
        if(Conf::getDebug()){
          echo $e->getMessage();
        }else {
           echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        }
    }
    }




}