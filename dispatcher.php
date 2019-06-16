<?php
class Dispatcher
{
    private $array = array();
    private $router = null;
    private $controller;
    private $method;
    private $params;
    private $userMethod = ["beforeRender", "render", "controlCreateUser", "controlGetUser", "controlGetAllUser", "controlDeleteUser", "displayLogin", "verifyLogin","displayUsers","controlUsersView", "controlUpdateUser", "displayUpdateUser","displayCreateUser"]; //par exemple
    private $articleMethod = ["displayArticles", "controlGetAllArticles", "controlGetArticle","controlCreateArticle","controlUpdateArticle", "controlDeleteArticle","controlGetViewArticles","controlGetOneArticle"];
    private $controleur;

    public function __construct(){
        require('Src/router.php');
        $this->router = new router;
    }
    
    public function getController(){
        if ($this->router != null){
            $this->controller = $this->router->fileExist();
            return $this->controller;
        }
        else{
            return false;
        }
    }
    
    public function getMethod(){
        if ($this->getController() != false){
            $this->method = $this->router->methodExist();
            if ($this->controller == "ArticlesController"){
                if(in_array($this->method, $this->articleMethod) == true){
                    $this->params = $this->router->getArrayParam();
                        $this->controleur = new $this->controller;
                          echo call_user_func_array([$this->controleur, $this->method], $this->params);
                    }
                }       
                else if ($this->controller == "UsersController"){
                    echo 'function Get method : usersController ';
                    if(in_array($this->method, $this->userMethod) == true){
                        $this->params = $this->router->getArrayParam();
                        $this->controleur = new $this->controller;
                          echo call_user_func_array([$this->controleur, $this->method], $this->params);
                    }
                }else{
                }
            }
        }
}

?>