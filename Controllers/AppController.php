<?php

class AppController {

    public static function CreateView($viewName){
        
        require_once("./Views/$viewName.php");
    }

    //loads the databas class so that it can be accessed in the controller by using $this->$model
    public function loadModel($model){ //$model would be an object instantiated from a model (user, article...) which is already connected to db.
        $this->model = new $model;
        return $this->model;
    }

    public function input($data){
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function secureInput($data){
        $data = trim($data);
        $data = $this->input($data);
        return $data;
    }
}

?>