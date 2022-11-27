<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use jcobhams\NewsApi\NewsApi;

class BaseController
{
    private FilesystemLoader $loader;
    private Environment $twig;
    private NewsApi $apiClient;

    public function __construct()
    {
        $this->loader = new FilesystemLoader('views');
        $this->twig = new Environment($this->loader);
        $this->apiClient = new NewsApi($_ENV['API_KEY']);
    }

    public function render(string $template, array $context = []): string
    {
        return $this->twig->render($template, $context);
    }

    public function newsApi(): NewsApi
    {
        return $this->apiClient;
    }
}