<?php
require_once(File::build_path(array("config", "Conf.php")));
//require_once ('../config/Conf.php');

class Model {

  public static $pdo;

  public static function Init(){

    $hostname = Conf::getHostname();
    $database_name = Conf::getDatabase();
    $login = Conf::getLogin();
    $password = Conf::getPassword();
    
    try{
      self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name",$login,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"));
      self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
      if (Conf::getDebug()) {
        echo $e->getMessage(); // affiche un message d'erreur
      }
      
      else {
        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      }
      die();
    }
  }



  public static function selectAll(){
    $table_name = 'projet_'.static::$object;

    $class_name = ucfirst(static::$object);
    try{
        $rep = self::$pdo->query("SELECT * FROM $table_name");
        $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $tab = $rep->fetchAll();
    }catch(PDOException $e){
        if(Conf::getDebug()){
          echo $e->getMessage();
        }else {
           echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        }
      die();

    }
    
    if(empty($tab))
      return false;
    return $tab;
  }

  public static function select($value){
    $table_name = 'projet_'.static::$object;
    $class_name = ucfirst(static::$object);
    $primary_key = static::$primaray;
    try{

    $req_prep = Model::$pdo->prepare("SELECT * from $table_name WHERE $primary_key=:primary");

    $values = array(
        ":primary" => $value,
    );
    $req_prep->execute($values);
    $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
    $tab_elem = $req_prep->fetchAll();

    }catch(PDOException $e){
        if(Conf::getDebug()){
          echo $e->getMessage();
        }else {
           echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        }
      die();

    }
    if (empty($tab_elem))
        return false;
    return $tab_elem[0];
  }

  public static function update($data){
    $table_name = 'projet_'.static::$object;
    $class_name = ucfirst(static::$object);
    $update = true;
    try{

        $set = "";
        $exe = [];
        foreach ($data as $key => $value) {
          $set .= $key."=:".$key.",";
          $exe[$key] = $value;
        }
        $set = rtrim($set, ",");

        
        $req_prep = Model::$pdo->prepare("UPDATE $table_name SET $set WHERE $primary_key=:$primary_key");
        $req_prep->execute($exe);

      }catch(PDOException $e){
        if(Conf::getDebug()){
          echo $e->getMessage();
        }else {
           echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        }
        $update = false;
    }
    return $update;
  }


  public static function save($data){
      $table_name = 'projet_'.static::$object;
      $created = true;
      try{

        $insert = "";
        $values = "";
        $exe = [];
        foreach ($data as $key => $value) {
          $insert .= $key.",";
          $values .= ":".$key.",";
          $exe[$key] = $value;
        }
        $insert = rtrim($insert, ",");
        $values = rtrim($values, ",");

        
        $req_prep = Model::$pdo->prepare("INSERT INTO $table_name($insert) VALUES($values)");
        $req_prep->execute($exe);

      }catch(PDOException $e){
        if(Conf::getDebug()){
          echo $e->getMessage();
        }else {
           echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        }
        $created = false;
    }
    return $created;
  }

   public static function delete($primary){
      $table_name = 'projet_'.static::$object;
      $class_name = ucfirst(static::$object);
        $delete = true;
      try{

        $req_prep = Model::$pdo->prepare("DELETE FROM $table_name WHERE $primary_key=:i");
        $req_prep->execute([
          ':i' => $primary,
        ]);

      }catch(PDOException $e){
        if(Conf::getDebug()){
          echo $e->getMessage();
        }else {
           echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        }
        $delete = false;
      }
      return $delete;
    }





}

Model::Init();

?>