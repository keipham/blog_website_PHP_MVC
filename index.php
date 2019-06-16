<?php
//echo __DIR__;
require_once __DIR__.'/Routes/Routes.php';
require_once __DIR__.'/navbar.php';
/*
function __autoload($class_name){
        echo ' autoload : '.$class_name;
        if (file_exists('./classes/'.$class_name.'.php')){
                require_once'./classes/'.$class_name.'.php';
        } else if (file_exists('./Controllers/'.$class_name.'.php')){
                require_once'./Controllers/'.$class_name.'.php';
        }       
}*/

require_once __DIR__.'/dispatcher.php';
// require_once('ArticlesController/controlGetViewArticles');
        $dispatcher = new Dispatcher;
        $dispatcher->getController();
        $dispatcher->getMethod();

?>