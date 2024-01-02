<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class DeleteVideoController
{

    public function __construct(private VideoRepository $VideoRepository)
    {

    }

    public function processarRequisicao(): void
    {

        $id = $_GET['id'];
        
        // $repository = new VideoRepository($pdo);
        $deleteVideo = $this->VideoRepository->remover($id);
        
        if ($deleteVideo === false){
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
    }
}