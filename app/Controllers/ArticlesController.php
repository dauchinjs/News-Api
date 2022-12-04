<?php declare(strict_types=1);


namespace App\Controllers;

use App\Services\Article\ArticleService;
use App\Template;

class ArticlesController
{
    public function articles(): Template
    {
        $search = $_GET['search'] ?? 'Formula 1';
        $category = $_GET['category'] ?? null;

        $articles = (new ArticleService())->execute($search, $category);

        return new Template(
            'index.twig',
            ['articles' => $articles->get()]
        );
    }
}