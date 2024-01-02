<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class VideoListController implements Controller
{

    public function __construct(private VideoRepository $VideoRepository)
    {

    }

    public function processarRequisicao(): void
    {
        $videoList = $this->VideoRepository->all();
        require_once __DIR__ . '/../../views/video_list.php';
    }
}