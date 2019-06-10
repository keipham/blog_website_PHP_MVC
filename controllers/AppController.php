<?php

class AppController {

    public static function CreateView($viewName){
        
        require_once("./views/$viewName.php");
    }
}

?>