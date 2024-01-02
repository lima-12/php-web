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
$VideoRepository = new VideoRepository($pdo);

// var_dump($_SERVER['PATH_INFO']);

if (!array_key_exists('PATH_INFO', $_SERVER) || $_SERVER['PATH_INFO'] === '/') {

    $controller = new VideoListController($VideoRepository);

} elseif ($_SERVER['PATH_INFO'] === '/novo_video') {

    if ($_SERVER['REQUEST_METHOD'] === 'GET') { 

        $controller = new VideoFormController($VideoRepository);

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $controller = new AddVideoController($VideoRepository);

    }

}  elseif ($_SERVER['PATH_INFO'] === '/editar_video') {

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $controller = new VideoFormController($VideoRepository);

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $controller = new EditVideoController($VideoRepository);

    }

} elseif ($_SERVER['PATH_INFO'] === '/remover_video') {

    $controller = new DeleteVideoController($VideoRepository);

} else {
    $controller = new Error404Controler($VideoRepository);
}

$controller->processarRequisicao();