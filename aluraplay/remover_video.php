<?php

use Alura\Mvc\Repository\VideoRepository;

$id = $_GET['id'];

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$repository = new VideoRepository($pdo);
$deleteVideo = $repository->remover($id);

if ($sdeleteVideo === false){
    header('Location: /?sucesso=0');
} else {
    header('Location: /?sucesso=1');
}