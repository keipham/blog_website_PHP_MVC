<?php
//echo __DIR__;
class router
{
    protected $controller = 'AppController'; 
    protected $method;
    protected $params = [];
    protected $url;

    public function parseUrl(){
        if (isset($_SERVER['REQUEST_URI']))
        {
            //echo 'je passe dans parse URL';
            echo $_GET['url'];
            return $this->url = explode('/', filter_var(rtrim($_GET['url'],'/')), FILTER_SANITIZE_URL);
        }
    }

    public function __construct(){
        $this->url = $this->parseUrl(); 

    }
 

    public function fileExist(){
        if(isset($this->url[0])){
            if(file_exists(dirname(__DIR__).'/Controllers/'.$this->url[0].'.php')){
                $this->controller = $this->url[0];
                //echo $this->controller;
                return $this->controller;
            }
            else{
                 return false;
            }
        }else{
            return false;
        }
    }

    public function methodExist(){
        if($this->fileExist() !== false){
            require_once dirname(__DIR__).'/Controllers/'.$this->controller.'.php';
            $this->controller = new $this->controller;
            if (isset($this->url[1])){
                if(method_exists($this->controller, $this->url[1])){ 
                    //method_exists vérifie si la méthode existe pour l'objet object fourni (instance d'objet ou nom de classe). 
                    $this->method = $this->url[1];
                    return $this->method;
                }else{ 
                    echo "The given method does not exist within the given controller.<br>";
                    echo $this->url[1];
                }
            } else if(file_exists(dirname(__DIR__).'/Views/'.$this->url[0].'.php')){
                //render view
                echo 'je rends la vue';
                AppController::CreateView($this->url[0]);
            } else {
                return false;
            }
        }else{
            return false;
        }
       
    }

    public function getArrayParam(){
        if($this->methodExist() !== false){
            unset($this->url[0]);
            unset($this->url[1]);
            $this->params = $this->url ? array_values($this->url): []; //array_values retourne toutes les valeurs d'un tableau
            return $this->params;
        }else{
            return false;
        }
    }       
}

?>