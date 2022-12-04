<?php declare(strict_types=1);

require_once '../vendor/autoload.php';

use App\Controllers\ArticlesController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\RegisterController;
use App\Models\User;
use Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$dotenv = Dotenv::createImmutable('/home/davids/Desktop/CODELEX/8.dala');
$dotenv->load();

session_start();

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $route) {
    $route->addRoute('GET', '/', [ArticlesController::class, 'articles']);
    $route->addRoute('GET', '/register', [RegisterController::class, 'showForm']);
    $route->addRoute('POST', '/register', [RegisterController::class, 'store']);
    $route->addRoute('GET', '/login', [LoginController::class, 'showForm']);
    $route->addRoute('POST', '/login', [LoginController::class, 'execute']);
    $route->addRoute('GET', '/logout', [LogoutController::class, 'exit']);
});

$loader = new FilesystemLoader('../views');
$twig = new Environment($loader);

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$controller, $method] = $handler;

        $response = (new $controller)->{$method}($vars);

        $userID = $_SESSION['users'];
        $twig->addGlobal('userID', $userID);

        if ($userID !== null) {
            $user = new User($userID);

            $twig->addGlobal('users', $user->getName());
        }

        if ($response instanceof \App\Template) {
            echo $twig->render($response->getPath(), $response->getParameters());
        }

        if ($response instanceof \App\Redirect) {
            header('Location: ' . $response->getUrl());
        }

        break;
}
