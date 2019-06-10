<?php
$testuser = false;
if(!empty($_POST))
{
    extract($_POST);
   
    $errors = array();
    require_once('../Models/User.php');
    $modelVerify = new user;
    require_once('../controllers/UsersController.php');
    $verify = new UsersController;
    
    if(strlen($username) < 3) 
    {
        array_push($errors, "Invalid username. Min 3 characters required.\n");
    }
    if($modelVerify->existUser($username) != false || $modelVerify->existEmail($email) != false){
        array_push($errors, "The username or email is already taken.\n");
    }
    if($verify->input($username) != $username){
        array_push($errors, "The username is not valid.\n");
    }
    if($verify->input($password) != $password){
        array_push($errors, "The password is not valid.\n");
    }
    if(!preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/", $email)){
        array_push($errors, "The email is not valid.\n");
    }
    if ($password != $passwordconf){
        array_push($errors, "The password verification is not valid.\n");
    }
    
    if(empty($errors))
    {   session_start();
        $_SESSION["email"] = $email;
        $_SESSION["username"] = $username;
        $id = $modelVerify->getID($_SESSION["username"]);
        $_SESSION["id"]= $id;

        $testuser = true;
    
        header("Location:/blog_website_PHP_MVC_architecture/UsersController/controlCreateUser/".$username."/".$email."/".$password."/".$passwordconf);
        die();
    }
}

?>
<!DOCTYPE html>
<html>
<?php require_once('navbar.php'); ?>
<body>

    <div class='container' >
    <h3 class='mb-5' style='text-shadow: -1px 0px lightgrey'>Inscription</h3>
        <form method='post'>
     
<?php if(!empty($errors)) { ?>
    <ul>
           <?php foreach ($errors as $error) : ?>
           <li> <?php echo $error; ?> </li>
           <?php endforeach ?>      
    </ul>
<?php } ?>

<?php if($testuser == true) { ?>

<h1>Votre inscription a bien été prise en compte.</h1>
<?php } ?>
        <div class='form-group'>
                <label for='username'>Username</label>
                <input type='text' class='form-control' name='username' id='username' required><br>
            </div>
            <div class='form-group'>
                <label for='email'>Email</label>
                <input type='text' class='form-control' name='email' id='email' required><br>
            </div>
            <div class='form-group'>
                <label for='password'>Password</label>
                <input type='password' class='form-control' name='password' id='password' required><br>
            </div>
            <div class='form-group'>
                <label for='password'>Password confirmation</label>
                <input type='password' class='form-control' name='passwordconf' id='passwordconf' required><br>
            </div>
            <button class='btn btn-primary mb-4'>Sign Up</button> 
                <p>
                    Already have an account ? Login 
                    <a href='/perso/blog_website_PHP_MVC_architecture/login'>HERE</a>
                </p>
        </form>
    </div>
</body>
</html>