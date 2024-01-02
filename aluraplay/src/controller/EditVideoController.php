<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Entity\Video;

class EditVideoController implements Controller
{

    public function __construct(private VideoRepository $VideoRepository)
    {

    }

    public function processarRequisicao(): void
    {

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id === null){
            header('Location: /?sucesso=0');
            exit();
        }
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        if ($url === false){
            header('Location: /?sucesso=0');
            exit();
        }
        $title = filter_input(INPUT_POST, 'titulo');
        if ($title === false){
            header('Location: /?sucesso=0');
            exit();
        }

        $repository = $this->VideoRepository;

        $video = new Video($url, $title);
        $video->setId($id);

        $videoUpdate = $repository->update($video);


        if ($videoUpdate === false){
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }

    }
}