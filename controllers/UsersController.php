<?php
 require_once 'AppController.php';
 require_once '../Models/User.php';
class UsersController extends AppController
{
    private $user;
    // charge directement le model
    public function __construct(){
        $this->user = $this->loadModel("User");
    }

    public function verifyLogin(){
        echo "salut";
        session_start();
        if(!isset($_SESSION)){
            header("Location: /perso/blog_website_PHP_MVC_architecture/UsersController/Views/login.php");
        }else{
            header("Location: /perso/blog_website_PHP_MVC_architecture/ArticlesController/controlGetViewArticles");
        }
    }

    //mettre à jour les coordonnées du User 
    public function controlUpdateUser($id, $username, $email, $password, $passwordconf, $groupe = "user", $status = "NO"){
        if($username == null || $email == null || $password == null || $passwordconf == null || $id == null || $groupe == null){
            return false;
        }else{
            $id = intval($id);
            if(is_int($id)){
                $result = $this->user->existUserId($id);
                if($result != false){
                    $username = $this->secureInput($username);
                    $email = $this->secureInput($email);
                    $password = $this->secureInput($password);
                    $passwordconf = $this->secureInput($passwordconf);
                    $article = $this->user->updateUser($id, $username, $email, $password, $passwordconf, $groupe, $status);
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }

    //afficher la page de mise à jour du user
    public function displayUpdateUser(){
        require_once("../Views/updateUser.php");
    }

    //créer un nouveau user, par exemple à partir de l'inscription
    public function controlCreateUser($username, $email, $password, $passwordconf, $groupe = "user", $status = "NO"){
        $resultUser = $this->user->existUser($username);
        $resultEmail = $this->user->existEmail($email);
        if($resultEmail == false && $resultEmail == false){
            if(strlen($username) >= 3 && strlen($username)<= 10 && ($this->secureInput($username) == $username)){
                if($this->input($username) == $username){
                    if(preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/", $email)){
                        if ($password == $passwordconf){
                            $this->user->createUser($username, $password, $email,$groupe);
                            // header("Location : /perso/blog_website_PHP_MVC_architecture/ArticlesController/controlGetViewArticles");
                        }else{
                            return false;
                        }
                    }else{ 
                        return false;
                    }
                }else{ 
                    return false;
                }
            }
        }else{
            return false;
        }
    }

    public function displayCreateUser(){
        require_once('../Views/createUser.php');
    }

    //obtenir un User à partir de son id
    public function controlGetUser($id = null){
        if($id != null){
            if(is_int($id)){
                $result = $this->user->existUserId($id);
                if($result){
                    $users = $this->user->getUser($id);
                    foreach ($users as $key => $user){
                        $users[$key]['username'] = htmlspecialchars($user['username']);
                        $users[$key]['password'] = htmlspecialchars($user['password']);
                        $users[$key]['groupe'] = htmlspecialchars($user['groupe']);
                    }
                    return $users;
                }else{
                    echo "This id doesn't exist in the base";
                    return false;
                }
            }else{
                echo "The parameters isn't a number";
                return false;
            }
        }
        else{
            echo "The parameters doesn't exist";
            return false;
        }
    }

    // supprimer un User à partir de son id
    public function controlDeleteUser($id){
        if($id != null)
        {
            $id = intval($id);

            if(is_int($id))
            {
                $result = $this->user->existUserId($id);
                if($result)
                {
                    $this->user->deleteUser($id);
                    header("Location:controlGetAllUser");
                    return true;
                }
                else
                {
                    echo "This id doesn't exist on the base";
                    return false;
                }
            }
            else
            {
                echo "this is not a number";
            }
        }
        else
        {
            echo "The parameters doesn't exist";
            return false;
        }
            
    }

    // obtenir tous les user de la table
    public function controlGetAllUser(){
        $users = $this->user->getAllUsers();
        foreach($users as $key => $user){
            $users[$key]['username'] = htmlspecialchars($user['username']);
            $users[$key]['email'] = htmlspecialchars($user['email']);
            $users[$key]['status'] = htmlspecialchars($user['status']);
        }
        require_once("../Views/usersView.php");
        // $this->render("usersView");
    }

    //vue sur tous les users
    public function controlUsersView(){
        $users = $this->user->getAllUsers();
        foreach($users as $key => $user){
            $users[$key]['username'] = htmlspecialchars($user['username']);
            $users[$key]['email'] = htmlspecialchars($user['email']);
            $users[$key]['status'] = htmlspecialchars($user['status']);
        }
        require("../Views/usersDisplay.php");
        $this->render("usersDisplay");
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