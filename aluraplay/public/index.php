<?php

declare(strict_types=1);

use Alura\Mvc\Controller\{
    Controller,
    DeleteVideoController,
    VideoListController,
    AddVideoController,
    EditVideoController,
    VideoFormController,
    Error404Controler
};
use Alura\Mvc\Repository\VideoRepository;

require_once __DIR__ . "/../vendor/autoload.php";

$dbPath = __DIR__ . '/../banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$VideoRepository = new VideoRepository(
    $pdo);

$routes = require_once __DIR__ . '/../config/routes.php';
// print_r($routes); exit();

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];
// var_dump($_SERVER['PATH_INFO']);

$key = "$httpMethod|$pathInfo";
if(array_key_exists($key, $routes)){
    $controllerClass = $routes["$httpMethod|$pathInfo"];
    // print_r($controllerClass); exit();
    
    $controller = new $controllerClass($VideoRepository);
    // echo "<pre>"; print_r($controller); exit();
} else {
    $controller = new Error404Controler();
}

$controller->processarRequisicao();