<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\FlashMessageTrait;
use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Entity\Video;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class NewVideoController implements RequestHandlerInterface
{
    use FlashMessageTrait;

    public function __construct(private VideoRepository $VideoRepository)
    {

    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getParsedBody();

        $url = filter_var($queryParams['url'], FILTER_VALIDATE_URL);
        if ($url === false){
            $this->addErrorMessage("Url não informada!");
            return new Response(302, [
                'Location' => '/novo_video'
            ]);
        }

        $title = filter_var($queryParams['title']);
        if ($title === false){
            $this->addErrorMessage("Título não informado!");
            return new Response(302, [
                'Location' => '/novo_video'
            ]);
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
            $this->addErrorMessage("Erro ao cadastrar vídeo!");
            return new Response(302, [
                'Location' => '/novo_video'
            ]);
        } else {
            return new Response(302, [
                'Location' => '/'
            ]);
        }
    }
}