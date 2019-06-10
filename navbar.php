<head>
 <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Article</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="" rel="stylesheet" type="text/css" >    

    <script src="main.js"></script>

 </head>
 <nav class="navbar navbar-expand-lg navbar-light mb-3" style="background-color:#e3e3e3">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/perso/blog_website_PHP_MVC_architecture/index">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Categories</a>  <!--Créer page catégorie -->
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Profile</a> 
      </li>
      <?php  if((isset($_SESSION["admin"]) && $_SESSION["admin"] ==1) || (isset($_COOKIE["admin"]) && $_SESSION["admin"] ==1)){?>
      <li class="nav-item">
        <a class="nav-link" href="admin.php">Admin managements</a> <!--Créer page profil -->
      </li>
      <?php }?>
      <li class="nav-item">
        <a class="nav-link" href="/perso/blog_website_PHP_MVC_architecture/contact-us">Contact us</a> 
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/perso/blog_website_PHP_MVC_architecture/login">Sign in</a> 
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/perso/blog_website_PHP_MVC_architecture/register">Sign up</a> 
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="/perso/blog_website_PHP_MVC_architecture/UsersControllers/logout">Logout</a>
      </li>
 
    </ul>
    
  </div>
</nav>