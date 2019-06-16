<?php
//echo __DIR__;
require_once(__DIR__.'/Models.php');

class User extends Models{

    public function __construct() {
        parent::__construct();
        
    }
    public static function getAllUsers(){
        $table = "user";
        return $this->getAllElements($table);
    }

    public static function getId($username){
        $sql = "SELECT id FROM user WHERE username = :username";
        $stmt= $this->conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result['id'];
    }

    public static function getUser($id){
        $table = "user";
        return $this->getElement($id,$table);
    }

    public static function getUserGroup($username){
        $sql = "SELECT groupe FROM user WHERE username = :username";
        $stmt= $this->conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result['groupe'];
    }

    public static function existUser($username){
        echo 'inside existUser';
        $table = "user";
        $column = "user_name";
        $result = parent::existElement($column, $username, $table);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public static function createUser($username, $password, $email, $groupe, $status = "NO"){
        
        $sql = "INSERT INTO user (user_name, user_password, user_email, user_group, user_status, created_by, updated_by) VALUES (:username, :password, :email, :groupe, :status, :username,:username"; // préparation des étiquettes
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

    public static function updateUser($id, $username, $password, $email, $groupe, $status = "NO"){
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

    public static function deleteUser($id){
        $table = "user";
        return $this->deleteElement($id,$table);
    }

    public static function logout(){
        unset($_SESSION);
        unset($_COOKIE['username']);
        setcookie("username","",time() - 3600);
        session_destroy();
        header('Location: /perso/blog_website_PHP_MVC_architecture/UsersController/render/login');
    }
}



?>