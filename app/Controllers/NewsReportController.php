<?php declare(strict_types=1);

namespace App\Controllers;

use App\Services\ArticleService;
use App\Template;

class NewsReportController
{
    public function articles(): Template
    {
        $search = $_GET['search'] ?? 'Formula 1';
        $category = $_GET['category'] ?? null;

        $articles = (new ArticleService())->execute($search, $category);

        return new Template(
            'articles/index.html.twig',
            [
                'articles' => $articles->get()
            ]
        );
    }
}
