<?php declare(strict_types=1);

namespace App\Controllers;

use App\Models\Article;
use jcobhams\NewsApi\NewsApi;

class NewsReportController extends BaseController
{
    public function articles(): string
    {
        $keyword = $_GET['search'] ?? 'Formula 1';

//        $newsApi = new NewsApi($_ENV['API_KEY']);
        $articlesApiResponse = $this->newsApi()->getEverything($keyword);

        $articles = [];

        foreach ($articlesApiResponse->articles as $article) {
            $articles [] = new Article(
                $article->title,
                $article->url,
                $article->description,
                $article->urlToImage
            );
        }
//        echo "<pre>";
//        return $articles;
        return $this->render('index.html.twig', ['keyword' => $keyword, 'articles' => $articles]);
    }
}

