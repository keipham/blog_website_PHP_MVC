<?php

class Database
{
    public $conn;
    private static $instance;
    private static $pdo;

    public static function getInstance(){
      if (!isset(self::$instance)){
        $instance = new Database;
      }
      echo 'Start database !';
      return $instance;
    }

    private function __construct() {
      /* PRIVATE */
      try{
          $this->conn = new PDO('mysql:host=127.0.0.1;dbname=blog_php_mvc','root','root');
          //$pdo = new PDO("mysql:host=127.0.0.1;dbName=blog_php_mvc", "root", "root"); 
      }
      catch(PDOException $e){
          // En cas d'erreur on affiche un message et on arrete tout
          echo 'Erreur :' .$e->getMessage();
      }
    }


    public function getConnection()
    {
        return $this->conn;
    }
}
/*
$instance = Database::getInstance();
$req = $instance->conn->query('select * from blog_php_mvc.user');
while ($d = $req->fetch()){
  print_r($d);
}*/
?>