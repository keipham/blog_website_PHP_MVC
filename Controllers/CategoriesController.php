<?php

require_once '../Models/Category.php';
require_once 'AppController.php';

class CategoriesController extends AppController{
    private $categoryModel;

    public function __construct(){
        $this->categoryModel = $this->loadModel("Category");
    }

    public function displayCategories(){
       return $this->render("categoriesView");
    }

    public function controlGetAllCategories(){
        $categories = $this->categoryModel->getAllArticles();

        foreach ($categories as $key => $category){
            $categories[$key]['author'] = htmlspecialchars($category['author']);
            $categories[$key]['title'] = htmlspecialchars($category['title']);
            $categories[$key]['category'] = htmlspecialchars($category['category']);
        }
        require_once("../Views/categoriesView.php");
        $this->displayArticles();
    }

    public function controlGetViewCategories(){
        $categories = $this->categoryModel->getAllArticles();

        foreach ($categories as $key => $category){
            $categories[$key]['author'] = htmlspecialchars($category['author']);
            $categories[$key]['title'] = htmlspecialchars($category['title']);
            $categories[$key]['category'] = htmlspecialchars($category['category']);
        }
        require_once("../Views/categoriesDisplay.php");
        $this->render("categoriesDisplay");
    }

    public function controlGetCategory($id = null){
        if($id != null){
            if(is_int($id)){
                $result = $this->categoryModel->existCategoryId($id);
                if($result){
                    $categories = $this->categoryModel->getCategory($id);
                    foreach ($categories as $key => $category){
                        $categories[$key]['author'] = htmlspecialchars($category['author']);
                        $categories[$key]['title'] = htmlspecialchars($category['title']);
                        $categories[$key]['category'] = htmlspecialchars($category['category']);
                    }
                    return $categories;
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

    public function controlCreateCategory($autor = null, $title = null, $category = null, $tag = null){
        if($author == null || $title == null || $category == null || $tag == null){
            echo "Not enough parameters";
            return false;
        }else{
            $result = $this->categoryModel->existCategory($title);
            if($result == false){
                $title = $this->secureInput($author);
                $content = $this->secureInput($title);
                $created_by = $this->secureInput($category);
                $created_by = $this->secureInput($tag);
                $article = $this->categoryModel->createCategory($author, $title, $category, $tag);
                return true;
            }else{
                echo "An article with the same title exist already, please choose another one.";
                return false;
            }
        }
    }

    public function controlUpdateCategory($id = null,$title = null, $content = null, $created_by = null){
        if($title == null || $content == null || $created_by == null || $id == null){
            echo "Not enough parameters";
            return false;
        }else{
            $id = intval($id);
            if(is_int($id)){
                $result = $this->categoryModel->existArticleId($id);
                if($result != false){
                    $title = $this->secureInput($author);
                    $content = $this->secureInput(nl2br($title));
                    $created_by = $this->secureInput($category);
                    $created_by = $this->secureInput($tag);
                    $article = $this->categoryModel->updateArticle($id, $author, $title, $category);
                    return true;
                }else{
                    echo "This category doesn't exist, you can't update it";
                    return false;
                }
            }else{
                echo "the id isn't a number";
                return false;
            }
        }
    }

    public function controlDeleteCategory($id = null){
        if($id != null){            
            if(is_int($id)){
                $result = $this->categoryModel->existCategoryId($id);
                if($result){
                    $this->categoryModel->deleteCategory($id);
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