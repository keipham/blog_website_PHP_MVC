<?php
class Database
{
    protected $conn;
    private static $instance;

    public static function getInstance(){
      if (!isset(self::$instance)){
        $instance = new Database;
      }
      return self::$instance;
    }

    private function __construct() {
      /* PRIVATE */
      try{
          $this->conn = new PDO('mysql:host=127.0.0.1;dbname=blog_php_mvc;charset=utf8', 'root', 'root');
      }
      catch(Exception $e){
          // En cas d'erreur on affiche un message et on arrete tout
          echo 'Erreur :' .$e->getMessage();
      }
    }


    public function getConnection()
    {
        return $this->conn;
    }
}

// $instance = db::getInstance();
// $instance->conn = $instance->getConnection();
?>