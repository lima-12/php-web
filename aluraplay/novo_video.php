<?php

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);

if ($url === false){
    header('Location: /?sucesso=0');
    exit;
}
$title = filter_input(INPUT_POST, 'titulo');
if ($title === false){
    header('Location: /?sucesso=0');
    exit;
}

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$repository = new VideoRepository($pdo);
$video = $repository->add(new Video($url, $title));

if($video === false){
    header('Location: /?sucesso=0');
} else {
    header('Location: /?sucesso=1');
}

