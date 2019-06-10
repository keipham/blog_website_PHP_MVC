<?php
require_once('Models.php');

class article extends Models{

    public function getAllArticles(){
        $table = "article";
        return $this->getAllElements($table);
    }

    public function getArticle($id){
        $table = "article";
        $id = intval($id);
        return $this->getElement($id,$table);
    }

    public function existArticle($title){
        $table = "article";
        $column = "title";
        $result = $this->existElement($column, $title, $table);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function existArticleId($id){
        $table = "article";
        $result = $this->existElementId($id,$table);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function createArticle($title, $content, $created_by){
        $sql = "INSERT INTO article (title, content,created_by,creation_date,edition_date) VALUES (:title, :content,:created_by, NOW(),NOW())"; // préparation des étiquettes
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":created_by", $created_by);
        $result = $stmt->execute();

        return $result;
    }

    public function updateArticle($id, $title = null, $content = null,$created_by = null){
        $sql = "UPDATE article SET title = :title, content = :content, created_by = :created_by, edition_date = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":created_by", $created_by);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    public function deleteArticle($id){
        $table = "article";
        return $this->deleteElement($id,$table);
    }
}

$kei = new article();
// $content = "Ils sont féroces";
// $title = "Les requins";
// $created_by = "Sylvie";
// $kei->existArticleId(1);
?>