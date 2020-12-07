<?php
require_once(File::build_path(array("model", "Model.php")));
require_once File::build_path(['model', 'Livre.php']);

class Categorie extends Model{
   
  private $idCategorie;
  private $nom;
  

  protected static $object = "categorie";
  protected static $primary = "idCategorie";
      
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
        $this->$key = $value;
      }
    }
  } 

  public static function selectFromSearch($search){
    try{


        $q = Model::$pdo->prepare("SELECT * FROM projet_categorie WHERE nom LIKE :nom");
        $q->execute([':nom' => "%$search%"]);
        $q->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
        $tab_cat = $q->fetchAll();
      }catch(PDOException $e){
        if(Conf::getDebug()){
          echo $e->getMessage();
        }else {
           echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        }
    }

    if(empty($tab_cat))
        return false;
    return $tab_cat;
  }
           


}
?>

