<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Entity\Video;

class AddVideoController implements Controller
{

    public function __construct(private VideoRepository $VideoRepository)
    {

    }

    public function processarRequisicao(): void
    {
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

        $repository = $this->VideoRepository;
        $video = $repository->add(new Video($url, $title));

        if($video === false){
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
    }
}