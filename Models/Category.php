<?php
require_once('Models.php');

class category extends Models{

    public function getAllCategories(){
        $table = "category";
        return $this->getAllElements($table);
    }

    public function getCategory($id){
        $table = "category";
        return $this->getElement($id,$table);
    }

    public function existCategory($title){
        $table = "category";
        $column = "title";
        $result = $this->existElement($column, $title, $table);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function existCategoryId($id){
        $table = "category";
        $result = $this->existElementId($id,$table);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function createCategory($author, $title, $category, $tag){
        $sql = "INSERT INTO category (author, title, date, category, tag) VALUES (:author, :title, NOW(),:category, :tag)"; // préparation des étiquettes
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":author", $author);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":category", $category);
        $stmt->bindParam(":tag", $tag);
        $result = $stmt->execute();

        return $result;
    }

    public function updateCategory($id, $author = null, $title = null, $category = null, $tag = null){
        $sql = "UPDATE category SET author = :author, title = :title, date = NOW(), category = :category, tag = :tag WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":author", $author);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":category", $category);
        $stmt->bindParam(":tag", $tag);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    public function deleteCategory($id){
        $table = "category";
        return $this->deleteElement($id,$table);
    }
}

?>