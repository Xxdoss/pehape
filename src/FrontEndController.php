<?php
namespace App;

use App\View;
use App\Model;
use App\Db;

class FrontEndController {
    private  $model;
    private  $view;

    public function __construct($model, $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function articleList()
    {
        $articles = $this->model->getArticles();
        $this->view->showArticleList($articles);
    }

    public function singleArticle($id)
    {
        $article = $this->model->getArticlesById($id);
        $this->view->showSingleArticle($article);
    }

    public function adminPage()
    {
        $this->view->showAdmin();
    }

    public function adminArticlesPage()
    {
        $articles = $this->model->getArticles();
        $this->view->showArticles($articles);
    }

    public  function  adminChangePage($id){
        echo 1;
        $article = $this->model->getArticlesById((int)$id);
        $this->view->showChanagePage($article);
    }
}