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

        $video = new Video($url, $title);

        // echo "<pre>"; print_r($_FILES); exit; #depurando

        if($_FILES['image']['error'] === UPLOAD_ERR_OK){
            move_uploaded_file(
                $_FILES['image']['tmp_name'], 
                __DIR__ . "/../../public/img/uploads/" . $_FILES['image']['name']
            );  
            $video->setFilePath($_FILES['image']['name']);
        }

        $repository = $this->VideoRepository;
        $video = $repository->add($video);

        if($video === false){
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
    }
}