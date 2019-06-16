<?php

class Route{

    public static $validRoutes = array();
    protected $url;

    public function parseUrl(){
        if (isset($_GET['url'])) {
    
            //return explode('/', filter_var(rtrim($this->url,'/')), FILTER_SANITIZE_URL);
            return explode('/', filter_var(rtrim($_GET['url'],'/')), FILTER_SANITIZE_URL);
        }
    }

    public static function set($route,$function){
        
        self::$validRoutes[] = $route;
        $parsedUrl = array();
        $parsedUrl = self::parseUrl();
        echo $myParsedUrl[0];
        if ($_GET['url'] == $route) {
            $function->__invoke();
        }
    }
}
?>