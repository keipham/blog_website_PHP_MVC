<?php

require_once '../Models/Article.php';
require_once 'AppController.php';

class ArticlesController extends AppController{
    private $articleModel;

    // charge le model Article
    public function __construct(){
        $this->articleModel = $this->loadModel("Article");
    }

    //vu pour l'admin pour modifier les articles
    public function controlGetAllArticles(){
        $articles = $this->articleModel->getAllArticles();

        foreach ($articles as $key => $article){
            $articles[$key]['title'] = htmlspecialchars($article['title']);
            $articles[$key]['content'] = nl2br(htmlspecialchars($article['content']));
            $articles[$key]['created_by'] = htmlspecialchars($article['created_by']);
        }
        require_once("../Views/articlesView.php");
    }

    // vu pour le user, pour lire les articles et poster des commentaires
    public function controlGetViewArticles(){
        $articles = $this->articleModel->getAllArticles();

        foreach ($articles as $key => $article){
            $articles[$key]['title'] = htmlspecialchars($article['title']);
            $articles[$key]['content'] = nl2br(htmlspecialchars($article['content']));
            $articles[$key]['created_by'] = htmlspecialchars($article['created_by']);
        }
        require_once("../Views/articlesDisplay.php");
        $this->render("articlesDisplay");
    }

    //obtenir un article à partir de son id
    public function controlGetArticle($id = null){
        if($id != null){
            $id = intval($id);
            if(is_int($id)){
                $result = $this->articleModel->existArticleId($id);
                if($result){
                    $articles = $this->articleModel->getArticle($id);
                    foreach ($articles as $key => $article){
                        $articles[$key]['title'] = htmlspecialchars($article['title']);
                        $articles[$key]['content'] = nl2br(htmlspecialchars($article['content']));
                        $articles[$key]['created_by'] = htmlspecialchars($article['created_by']);
                    }
                    require_once("../Views/displayArticle.php");

                    return $articles;
                }else{
                    echo "This id doesn't exist in the base";
                    return false;
                }
            }else{
                echo "The parameters isn't a number";
                return false;
            }
        }
        else{
            echo "The parameters doesn't exist";
            return false;
        }
    }

    // créer un nouvel article
    public function controlCreateArticle($title = null, $content = null){
        session_start();
        $created_by = $_SESSION['username'];
        if($title == null || $content == null || $created_by == null){
            echo "Not enough parameters";
            return false;
        }else{
            $result = $this->articleModel->existArticle($title);
            if($result == false){
                $title = $this->secureInput($title);
                $content = $this->secureInput(nl2br($content));
                $created_by = $this->secureInput($created_by);
                $article = $this->articleModel->createArticle($title, $content, $created_by);
                return true;
            }else{
                echo "An article with the same title exist already, please choose another one.";
                return false;
            }
        }
    }

    //modifier un article
    public function controlUpdateArticle($id = null,$title = null, $content = null, $created_by = null){
        if($title == null || $content == null || $created_by == null || $id == null){
            return false;
        }else{
            $id = intval($id);
            if(is_int($id)){
                $result = $this->articleModel->existArticleId($id);
                if($result != false){
                    $title = $this->secureInput($title);
                    $content = $this->secureInput(nl2br($content));
                    $created_by = $this->secureInput($created_by);
                    $article = $this->articleModel->updateArticle($id, $title, $content, $created_by);
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }

    //supprimer un article à partir de son id
    public function controlDeleteArticle($id = null){
        if($id != null){            
            if(is_int($id)){
                $result = $this->articleModel->existArticleId($id);
                if($result){
                    $this->articleModel->deleteArticle($id);
                    return true;
                }
                else{
                    echo "This id doesn't exist in the base";
                    return false;
                }
            }else{
                echo "The parameters is not a number";
                return false;
            }
        }else{
            echo "The parameters doesn't exist";
            return false;
        }
    }
}

// $x = new ArticlesController();

// var_dump($x->controlGetAllArticles());
?>