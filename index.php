<?php

require_once('./routes/Routes.php');
require_once('navbar.php');
function __autoload($class_name){
        if (file_exists('./classes/'.$class_name.'.php')){
                require_once'./classes/'.$class_name.'.php';
        } else if (file_exists('./controllers/'.$class_name.'.php')){
                require_once'./controllers/'.$class_name.'.php';
        }       
}
?>