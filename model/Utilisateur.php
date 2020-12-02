<?php
require_once File::build_path(['model','Model.php']);

class Utilisateur extends Model
{   
        private $nomUtilisateur;
        private $prenomUtilisateur;	
        private $mailUtilisateur;	
        private $idUtilisateur;	
        private $role;

        protected static $object = "utilisateur";
        protected static $primary = "idUtilisateur";
            
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
        } 

        public static function getUtilisateurByMail($mail){
          try {
                  $sql = "SELECT idUtilisateur, nomUtilisateur, prenomUtilisateur, mailUtilisateur, role FROM projet_utilisateur WHERE mailUtilisateur = :m";
                  // Préparation de la requête
                  $req_prep = Model::$pdo->prepare($sql);
      
                  $values = array(
                      ":m" => $mail
                      
                  );
                  // On donne les valeurs et on exécute la requête   
                  $req_prep->execute($values);
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
      
    
          public static function exist($mail){
            try {
                  $sql = "SELECT idUtilisateur FROM projet_utilisateur WHERE mailUtilisateur=:m";
                  // Préparation de la requête
                  $req_prep = Model::$pdo->prepare($sql);
      
                  $values = array(
                      ":m" => $mail
                      
                  );
                  // On donne les valeurs et on exécute la requête   
                  $req_prep->execute($values);
                  
                  $tab_id = $req_prep->fetchAll();
        
              } catch (PDOException $e) {
                  if (Conf::getDebug()) {
                      echo $e->getMessage(); // affiche un message d'erreur
                  } else {
                      echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                  }
                  die();
              }
              if(empty($tab_id))
                return false;
              return true;
          }

          public static function getMdpByMail($mail){
              try {
                  $sql = "SELECT mdpUtilisateur FROM projet_utilisateur WHERE mailUtilisateur=:m";
                  // Préparation de la requête
                  $req_prep = Model::$pdo->prepare($sql);
      
                  $values = array(
                      ":m" => $mail
                      
                  );
                  // On donne les valeurs et on exécute la requête   
                  $req_prep->execute($values);
                  
                  $tab_mdp = $req_prep->fetchAll();
        
              } catch (PDOException $e) {
                  if (Conf::getDebug()) {
                      echo $e->getMessage(); // affiche un message d'erreur
                  } else {
                      echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                  }
                  die();
              }
              if(empty($tab_mdp))
                return [];
              return $tab_mdp[0]['mdpUtilisateur'];
          }
      

      }
      
      ?>

