<?php
require_once File::build_path('Model.php');

class Utilisateur
{   
        private $nomUtilisateur;
        private $prenomUtilisateur;	
        private $mailUtilisateur;	
        private $mdpUtilisateur;
        private $idUtilisateur;	
        private $role;
            
        public function setAttr($attr, $value){
            $this->$attr = $value;
        }
    public function getAttr($attr){
            return $this->$attr;
        }
            
        function __construct($data = NULL)
        {
            if(!is_null($data)){
                foreach ($data as $key => $value) {
                    $this->key = $value;
                }
            }
        }
      
        
        public static function getUtilisateurId($idUtilisateur) {
          $sql = "SELECT * from projet_utilisateur WHERE idUtilisateur=:nom_tag";
          // Préparation de la requête
          $req_prep = Model::$pdo->prepare($sql);
      
          $values = array(
              "nom_tag" => $immat,
              //nomdutag => valeur, ...
              );
      
          // On donne les valeurs et on exécute la requête   
          $req_prep->execute($values);
      
          // On récupère les résultats comme précédemmerequire_once "Model.php";require_once "Model.php";nt
          $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
          $tab_voit = $req_prep->fetchAll();
          // Attention, si il n'y a pas de résultats, on renvoie false
          if (empty($tab_ut))
              return false;
          return $tab_ut[0];
        }
      
         public function save() {
              try {
                  $sql = "INSERT INTO projet_utilisateur (nomUtilisateur, prenomUtilisateur, mailUtilisateur, mdpUtilisateur, idUtilisateur, role
                  ) VALUES (:nomUtilisateur, :prenomUtilisateur, :mailUtilisateur, :mdpUtilisateur, :idUtilisateur, :role)";
                  // Préparation de la requête
                  $req_prep = Model::$pdo->prepare($sql);
      
                  $values = array(
                      "nomUtilisateur" => $this->nomUtilisateur,
                      "prenomUtilisateur" => $this->prenomUtilisateur,
                      "mailUtilisateur" => $this->mailUtilisateur,
                      "mdpUtilisateur" => $this->mdpUtilisateurr,
                      "idUtilisateur" => $this->idUtilisateur,
                      "role" => $this->role,
                  );
                  // On donne les valeurs et on exécute la requête   
                  $req_prep->execute($values);
          
        
              } catch (PDOException $e) {
                  if (Conf::getDebug()) {
                      echo $e->getMessage(); // affiche un message d'erreur
                  } else {
                      echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                  }
                  die();
              }
          }
      

      }
      
      ?>

}