<?php

class Route{

    public static $validRoutes = array();
    protected $url;

    public function parseUrl(){
        if (isset($_SERVER['REQUEST_URI'])) {
            print_r($_SERVER['REQUEST_URI']);
            $this->url = substr($_SERVER['REQUEST_URI'], 6, -1);
            print($this->url);
            return $this->url = explode('/', filter_var(rtrim($this->url,'/')), FILTER_SANITIZE_URL);
        }
    }

    public static function set($route,$function){
        
        self::$validRoutes[] = $route;
        
        if ($_GET['url'] == $route) {
            $function->__invoke();
        }
    }
}
?>