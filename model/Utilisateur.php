<?php
require_once File::build_path('Model.php');

class Utilisateur
{   
        private $nomUtilisateur;
        private $prenomUtilisateur;	
        private $mailUtilisateur;	
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

        public static function disconnect(){
            session_unset();
            session_destroy();
            header("Location:index.php");
        } 
      
        

         public static function saveUtilisateur($nomUtilisateur, $prenomUtilisateur, $crypt_mdp, $mdpUtilisateur, $idUtilisateur, $role) {
              try {
                  $sql = "INSERT INTO projet_utilisateur (nomUtilisateur, prenomUtilisateur, mailUtilisateur, mdpUtilisateur, idUtilisateur, role
                  ) VALUES (:nomUtilisateur, :prenomUtilisateur, :mailUtilisateur, :mdpUtilisateur, :idUtilisateur, :role)";
                  // Préparation de la requête
                  $req_prep = Model::$pdo->prepare($sql);
      
                  $values = array(
                      "nomUtilisateur" => $nomUtilisateur,
                      "prenomUtilisateur" => $prenomUtilisateur,
                      "mailUtilisateur" => $mailUtilisateur,
                      "mdpUtilisateur" => $$crypt_mdp,
                      "idUtilisateur" => $idUtilisateur,
                      "role" => $role,
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