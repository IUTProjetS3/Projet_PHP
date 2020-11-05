<?php
require_once(File::build_path(array("model", "Model.php")));
class ModelVoiture {
   
  private $idLivre;
  private $nom;
  private $description;
  private $prix;
  private $avis;
  private $image;
      
  // un getter      
  public function getidLivre() {
    return $this->idLivre;  
  }

  public function getNom(){
    return $this->nom;
  }

  public function getDescription(){
    return $this->description;
  }

  public function getPrix(){
    return $this->prix;
  }
  
  public function getAvis(){
    return $this->avis;
  }

  public function getImage(){
    return $this->image;
  }

  // un setter 
  public function setidLivre($idLivre2) {
    $this->idLivre = $idLivre2;
  }

  public function setNom($nom2){
    $this->nom = $nom2;
  }

  public function setDescription($description2){
    if (strlen($immatriculation2) <= 8) {
      $this->description = $description2;
    }
  }

  public function setMarque($marque2) {
    $this->marque = $marque2;
  }

  public function setMarque($marque2) {
    $this->marque = $marque2;
  }

  // un constructeur
  public function __construct($m = NULL, $c = NULL, $i = NULL){
    if (!is_null($m) && !is_null($c) && !is_null($i)) {
      $this->marque = $m;
      $this->couleur = $c;
      $this->immatriculation = $i;
    }
  } 
           
  // une methode d'affichage.
 /* public function afficher(){
    echo "marque = $this->marque, couleur = $this->couleur, immatriculation = $this->immatriculation";
  }*/

  public static function getAllVoitures() {
      try {
           $pdo = Model::$pdo;
           $sql = "SELECT * from voiture";
           $rep = $pdo->query($sql);
           $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelVoiture');
          return $rep->fetchAll();
      } catch (PDOException $e) {
          if (Conf::getDebug()) {
            echo $e->getMessage(); // affiche un message d'erreur
          } else {
              echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
          }
          die();
      }
  }

  public static function getVoitureByImmat($immat) {
    try {
        $sql = "SELECT * from voiture WHERE immatriculation=:nom_tag";
            // Préparation de la requête
       $req_prep = Model::$pdo->prepare($sql);

          $values = array(
              "nom_tag" => $immat,
                    //nomdutag => valeur, ...
          );
            // On donne les valeurs et on exécute la requête   
          $req_prep->execute($values);

            // On récupère les résultats comme précédemment
          $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelVoiture');
          $tab_voit = $req_prep->fetchAll();
            // Attention, si il n'y a pas de résultats, on renvoie false
           if (empty($tab_voit))
               return false;
          return $tab_voit[0];
      } catch (PDOException $e) {
          if (Conf::getDebug()) {
              echo $e->getMessage(); // affiche un message d'erreur
           } else {
               echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
           }
           die();
      }
  }

  public function save() {
          try {
              $sql = "INSERT INTO voiture (marque, couleur, immatriculation) VALUES ( :marque, :couleur, :immat)";
              //echo $sql;
              // Préparation de la requête
              $req_prep = Model::$pdo->prepare($sql);

              $values = array(
                "marque" => $this->marque,  
                "couleur" => $this->couleur,
                "immat" => $this->immatriculation,
              );
              // On donne les valeurs et on exécute la requête  

              return $req_prep->execute($values);
              
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

