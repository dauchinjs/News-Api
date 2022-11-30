<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Collections\ArticleCollection;
use jcobhams\NewsApi\NewsApi;

class ArticleService
{
    private NewsApi $api;

    public function __construct()
    {
        $this->api = new NewsApi($_ENV['API_KEY']);
    }

    public function execute(string $search, ?string $category = null): ArticleCollection
    {
        $articlesApiResponse = $this->getArticles($search, $category);

        $articles = new ArticleCollection();
        foreach ($articlesApiResponse->articles as $article) {
            $articles->add(new Article(
                $article->author,
                $article->title,
                $article->url,
                $article->description,
                $article->publishedAt,
                $article->urlToImage
            ));
        }
        return $articles;
    }

    private function getArticles(string $search, ?string $category = null)
    {
        if (!$category) {
            return $this->api->getEverything($search);
        }
        return $this->api->getTopHeadLines($category);   
    }
}
