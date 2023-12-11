<?php

namespace App;
class Model
{
    public function getArticles(): array
    {
        return json_decode(file_get_contents('articles.json'), true);
    }

    public function getArticlesById(int $id): array
    {
        $articleList = $this->getArticles();
        $currentArticle = [];
        foreach ($articleList as $ar) {
            if (array_key_exists($id, $articleList)) {
                $currentArticle = $articleList[$id];
            }
        }
        return $currentArticle;
    }
}