<?php

$control;
$testuser = false;
if(!empty($_POST))
{ 
    extract($_POST);
    
    require_once('../Models/User.php');
    require_once('../controllers/UsersController.php');
    $user = new user;
    $control = new UsersController;

    $username = htmlspecialchars($username);
    $password = htmlspecialchars($password);

    // $sql = "SELECT password, username
    //         FROM user
    //         WHERE username = :username";

    // $stmt = $conn->prepare($sql);
    // $stmt->bindParam(":username", $username);
    // $stmt->execute();
    // $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $result = $user->existUser($username);
    $id = intval($user->getId($username));
    $myUser = $control->controlGetUser($id);
    
    foreach($myUser as $key => $thisUser){
       $passwordcrypt = ($thisUser['password']);
       $email = $thisUser['email'];
    }
     
    
    if( $result != false)
    {
        if(password_verify($password, $passwordcrypt))  
        {
            $_SESSION["username"] = $username;
            var_dump($_SESSION["username"]);
            $_SESSION["email"]= $email;
            $_SESSION["id"]= $id;
            // if(isset($_POST['remember'])){
            //     $email = $_POST['email'];
            //     $this_username = $result->username;
            //     $admin_cookie = $result->admin;
            //     setcookie("email", $email, time() + 3600 * 24 * 60);
            //     setcookie("username", $this_username, time() + 3600 * 24 * 60);
            //     setcookie("id", $id, time() + 3600 * 24 * 60);
            //     setcookie("admin", $admin_cookie, time() + 3600 * 24 * 60);
            // }
            //require_once("../Models/User.php");
            var_dump($user->getUserGroup($_SESSION['username']));
            if ($user->getUserGroup($_SESSION['username']) == "admin"){
                header("Location:/perso/blog_website_PHP_MVC_architecture/ArticlesController/controlGetAllArticles");
                exit(); 
            }
            else if ($user->getUserGroup($_SESSION['username']) == "writer"){
            
            }
            else if ($user->getUserGroup($_SESSION['username']) == "user"){
                header("Location:/perso/blog_website_PHP_MVC_architecture/ArticlesController/controlGetViewArticles");
                exit();
                echo "I'm there"; 
           }
            
        } else {
        ?> <h2>Incorrect email/password</h2> <?php
        }
    } 
  }


?>

<!DOCTYPE html>
<html>
<?php require_once('navbar.php'); ?>
<body>

<div class='container'>
    <h3 class='mb-5' style='text-shadow: -1px 0px lightgrey'>Login</h3>

    <form method='post'>
    <div class='form-group'>
        Username: <input class='form-control' type='text' name='username'><br>
    </div>
    <div class='form-group'>
        Password: <input class='form-control' type='password' name='password'><br>
    </div>
    <label for='remerber-me' class='form-check-label'>Remember me</label>
    <div class='form-group form-check'>
        <input type='checkbox' class='form-check-input' name='remember' value='remember-be'><br>
    </div>
     <input class='btn btn-primary' type='submit' value='Log in'>
    <p> Don't have an account? Sign up <a href='/perso/blog_website_PHP_MVC_architecture/register'>HERE </a>
    <p> <a href='forgotpassword.php'> Forgot your password? </a>

    </form>
    </div>
    <footer class='page-footer font-small blue'>

<!-- Copyright -->
<div class='footer-copyright text-center py-3'>© 2019 Copyright:
  <a href='#'>blog_website_PHP_MVC_architecture</a>
</div>
<!-- Copyright -->

</footer>
</body>
</html>