<?php
require_once(dirname(__DIR__).'/Config/Database.php');

class Models{
    protected $instance;
    protected $conn;
    
    public function __construct(){
        $instance = Database::getInstance();
        $this->conn = $instance->getConnection();
    }

    public function existElement($column, $element, $table){
           
        $stmt = $this->conn->prepare("SELECT * FROM :dbtable WHERE :column = :element");
        
        $stmt->bindParam(":dbtable", $table, PDO::PARAM_STR);
        $stmt->bindParam(":column", $column, PDO::PARAM_STR);
        $stmt->bindParam(":element", $element, PDO::PARAM_STR);
        $stmt->execute(); 

        $result = $stmt->fetch();
        if($result){
            return TRUE; 
        }
        else{
            return FALSE;
        }
    }

    protected function existElementId($id, $table){
        $sql = "SELECT * FROM $table WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute(); 

        $result = $stmt->fetch();

        if($result){
            return TRUE; 
        }
        else{
            return FALSE;
        }
    }

    public function getAllElements($table){
        $sql = "SELECT * FROM $table";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getElement($id, $table){
        $sql = "SELECT * FROM $table WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function deleteElement($id, $table){
        $sql = "DELETE FROM $table WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
}

?>