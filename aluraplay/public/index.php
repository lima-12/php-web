<?php

declare(strict_types=1);

use Alura\Mvc\Controller\Error404Controler;

require_once __DIR__ . "/../vendor/autoload.php";

$routes = require_once __DIR__ . '/../config/routes.php';
// print_r($routes); exit();
/** @var \Psr\Container\ContainerInterface $diContainer */
$diContainer = require_once __DIR__ . '/../config/dependecies.php';

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];
// echo "<pre>"; print_r($_SERVER['PATH_INFO']); exit();
// echo "<pre>"; print_r($_SERVER['REQUEST_METHOD']); exit();

$isLoginRoute = $pathInfo === '/login';
session_start();
if(!array_key_exists('logado', $_SESSION) && !$isLoginRoute){
    header('Location: /login');
    return;
}

$key = "$httpMethod|$pathInfo";
if(array_key_exists($key, $routes)){
    $controllerClass = $routes["$httpMethod|$pathInfo"];
    // print_r($controllerClass); exit();

    $controller = $diContainer->get($controllerClass);
    // echo "<pre>"; print_r($controller); exit();
} else {
    $controller = new Error404Controler();
}

$psr17Factory = new \Nyholm\Psr7\Factory\Psr17Factory();

$creator = new \Nyholm\Psr7Server\ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$request = $creator->fromGlobals();

/** @var \Psr\Http\Server\RequestHandlerInterface $controller */
$response = $controller->handle($request);

http_response_code($response->getStatusCode());
foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header (sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();