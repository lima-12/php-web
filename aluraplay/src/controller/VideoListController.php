<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use PDO;

class VideoListController
{
    private VideoRepository $VideoRepository;

    public function __construct()
    {
        $dbPath = __DIR__ . '/banco.sqlite';
        $pdo = new PDO("sqlite:$dbPath");
        $this->VideoRepository = new VideoRepository($pdo);
    }

    public function processarRequisicao(): void
    {

    }
}