<?php
require_once(File::build_path(array("model", "Model.php")));
class Livre {
   
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

  public function setPrix($prix2){
    $this->prix = $prix2;
  }

  public function setAvis($avis2){
    $this->avis = $avis2;
  }

  public function setImage($image2){
    $this->image = $image2;
  }

  // un constructeur
  public function __construct($id = NULL, $n = NULL, $d = NULL, $p = NULL, $a = NULL, $i = NULL){
    if (!is_null($id) && !is_null($n) && !is_null($d) && !is_null($p) && !is_null($a) && !is_null($i)){
      $this->idLivre = $id;
      $this->nom = $n;
      $this->description = $d;
      $this->prix = $p;
      $this->avis = $a;
      $this->image = $i;
    }
  } 
           
  // une methode d'affichage.

  public static function getAllLivres() {
      try {
           $pdo = Model::$pdo;
           $sql = "SELECT * from projet_livre";
           $rep = $pdo->query($sql);
           $rep->setFetchMode(PDO::FETCH_CLASS, 'Livre');
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

  public static function getLivreByID($immat) {
    try {
        $sql = "SELECT * from voiture WHERE idLivre=:nom_tag";
            // Préparation de la requête
       $req_prep = Model::$pdo->prepare($sql);

          $values = array(
              "nom_tag" => $idLivre,
                    //nomdutag => valeur, ...
          );
            // On donne les valeurs et on exécute la requête   
          $req_prep->execute($values);

            // On récupère les résultats comme précédemment
          $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Livre');
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
              $sql = "INSERT INTO Livre (idLivre, nom, description, prix, avis, image) VALUES ( :idLivre, :nom, :description, :prix, :avis, :image)";
              //echo $sql;
              // Préparation de la requête
              $req_prep = Model::$pdo->prepare($sql);

              $values = array(
                "idLivre" => $this->idLivre,
                "nom" => $this->nom,
                "description" => $this->description,
                "prix" => $this->prix,
                "avis" => $this->avis,
                "image" => $this->image,
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

