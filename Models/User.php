<?php
require_once('Models.php');

class user extends Models{


    public function getAllUsers(){
        $table = "user";
        return $this->getAllElements($table);
    }

    public function getId($username){
        $sql = "SELECT id FROM user WHERE username = :username";
        $stmt= $this->conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result['id'];
    }

    public function getUser($id){
        $table = "user";
        return $this->getElement($id,$table);
    }

    public function getUserGroup($username){
        $sql = "SELECT groupe FROM user WHERE username = :username";
        $stmt= $this->conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result['groupe'];
    }

    public function existUser($username){
        $table = "user";
        $column = "user_name";
        $result = $this->existElement($column, $username, $table);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function existEmail($email){
        $table = "user";
        $column = "email";
        $result = $this->existElement($column, $email, $table);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function existUserId($id){
        $table = "user";
        $result = $this->existElementId($id,$table);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function createUser($username, $password, $email, $groupe, $status = "NO"){
        
        $sql = "INSERT INTO user (username, password, email, groupe, status, creation_date, edition_date) VALUES (:username, :password, :email, :groupe, :status, NOW(),NOW())"; // préparation des étiquettes
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $hash = password_hash($password, PASSWORD_DEFAULT);//password crypté
        $stmt->bindParam(":password", $hash);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":groupe", $groupe);
        $stmt->bindParam(":status", $status);
        $result = $stmt->execute();

        return $result;
    }

    public function updateUser($id, $username, $password, $email, $groupe, $status = "NO"){
        $sql = "UPDATE user SET username = :username, password = :password, email = :email, groupe = :groupe, status = :status, edition_date = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $hash = password_hash($password, PASSWORD_DEFAULT);//password crypté
        $stmt->bindParam(":password", $hash);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":groupe", $groupe);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    public function deleteUser($id){
        $table = "user";
        return $this->deleteElement($id,$table);
    }

    public function logout(){
        unset($_SESSION);
        unset($_COOKIE['username']);
        setcookie("username","",time() - 3600);
        session_destroy();
        header('Location: /perso/blog_website_PHP_MVC_architecture/UsersController/render/login');
    }
}



?>