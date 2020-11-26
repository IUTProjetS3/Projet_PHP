<?php
require_once(File::build_path(array("model", "Model.php")));
class Livre extends Model{
   
  private $idLivre;
  private $nom;
  private $description;
  private $prix;
  private $avis;
  private $image;

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
        $this->key = value;
      }
    }
  } 
           


}
?>

