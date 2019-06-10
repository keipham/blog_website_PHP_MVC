<?php

require_once('../Config/db.php');

class Models{
    protected $instance;
    protected $conn;
    
    public function __construct(){
        $instance = db::getInstance();
        $this->conn = $instance->getConnection();
    }

    protected function existElement($column, $element, $table){
        $sql = "SELECT * FROM $table WHERE $column = :element";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":element", $element);
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