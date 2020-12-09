<?php
require_once(File::build_path(array("model", "Model.php")));
require_once File::build_path(['model', 'Categorie.php']);

class Livre extends Model{
   
  private $idLivre;
  private $nom;
  private $description;
  private $prix;
  private $avis;
  private $image;
  private $categorie;

  protected static $object = "livre";
  protected static $primary = "idLivre";
      
  // SETTER      
  public function setAttr($attr, $value){
            $this->$attr = $value;
        }
  // GETTER
   public function getAttr($attr){
            return $this->$attr;
        }

  // un constructeur
  public function __construct($data = NULL){
    if (!is_null($data)){
      foreach ($data as $key => $value) {
        $this->key = $value;
      }
    }
  } 
  
  public static function linkCategorie($idLivre, $idCategorie){
    try{

        $q = Model::$pdo->prepare("INSERT INTO projet_appartient(idLivre, idCategorie) VALUES(:idLivre, :idCategorie)");
        $q->execute([
          ":idLivre" => $idLivre,
          ":idCategorie" => $idCategorie
        ]);
       
      }catch(PDOException $e){
        if(Conf::getDebug()){
          echo $e->getMessage();
        }else {
           echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        }
    }
    }

  public static function createLivre($data, $notkey){
    try{

        $q = Model::$pdo->prepare("SELECT * FROM projet_livre WHERE idLivre=:id");
        $q->execute([':id' => $data['idLivre']]);
        $tab_l = $q->fetchAll();
      }catch(PDOException $e){
        if(Conf::getDebug()){
          echo $e->getMessage();
        }else {
           echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        }
    }

    if(!empty($tab_l))
        return false;
    self::save($data, $notkey);
    return true;
  }

  public static function selectFromSearch($search){
    try{

        $q = Model::$pdo->prepare("SELECT * FROM projet_livre WHERE nom LIKE :nom");
        $q->execute([':nom' => "%$search%"]);
        $q->setFetchMode(PDO::FETCH_CLASS, 'Livre');
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
    return $tab_l;
  }
  
  public static function selectFromCat($cat){
    try{

        $q = Model::$pdo->prepare("SELECT * FROM projet_livre pl JOIN projet_appartient pa ON pl.idLivre = pa.idLivre WHERE pa.idCategorie=:cat");
        $q->execute([':cat' => $cat]);
        $q->setFetchMode(PDO::FETCH_CLASS, 'Livre');
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
    return $tab_l;
  }

  public function getCategorie(){
    try{

        $q = Model::$pdo->prepare("SELECT * FROM projet_categorie pc JOIN projet_appartient pa ON pc.idCategorie = pa.idCategorie WHERE pa.idLivre=:idLivre");
        $q->execute([':idLivre' => $this->idLivre]);
        $q->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
        $tab_c = $q->fetchAll();
      }catch(PDOException $e){
        if(Conf::getDebug()){
          echo $e->getMessage();
        }else {
           echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        }
    }

    if(empty($tab_c)){
        $this->categorie = new Categorie(["idCategorie" => -1, "nom" => "Catégorie..."]);
      }else{
      $this->categorie = $tab_c[0];
    }
  }

  public static function setCategorie($idLivre, $idCategorie){
    try{

        $q = Model::$pdo->prepare("UPDATE projet_appartient SET idCategorie =:idCategorie WHERE idLivre=:idLivre");
        $q->execute([':idLivre' => $idLivre, ":idCategorie" => $idCategorie]);
      }catch(PDOException $e){
        if(Conf::getDebug()){
          echo $e->getMessage();
        }else {
           echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        }
    }
  }
  


}
?>

