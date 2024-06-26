<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\FlashMessageTrait;
use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Entity\Video;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class EditVideoController implements RequestHandlerInterface
{
    use FlashMessageTrait;

    public function __construct(private VideoRepository $VideoRepository)
    {

    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();

        #$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $id = filter_var($queryParams['id'], FILTER_VALIDATE_INT);
        if ($id === false || $id === null){
            // header('Location: /?sucesso=0');
            $this->addErrorMessage('Id inválido!');
            return new Response(302, [
                'Location' => '/'
            ]);
            // exit();
        }
        $url = filter_ver($queryParams['url'], FILTER_VALIDATE_URL);
        if ($url === false){
            $this->addErrorMessage('Url inválido!');
            return new Response(302, [
                'Location' => '/'
            ]);
        }
        $title = filter_var($queryParams['title']);
        if ($title === false){
            $this->addErrorMessage('Title inválido!');
            return new Response(302, [
                'Location' => '/'
            ]);
        }

        $repository = $this->VideoRepository;

        $video = new Video($url, $title);
        $video->setId($id);

        if($_FILES['image']['error'] === UPLOAD_ERR_OK){
            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                __DIR__ . "/../../public/img/uploads/" . $_FILES['image']['name']
            );
            $video->setFilePath($_FILES['image']['name']);
        }

        $videoUpdate = $repository->update($video);

        if ($videoUpdate === false){
            $this->addErrorMessage('Erro ao editar video!');
            return new Response(302, [
                'Location' => '/'
            ]);
        } else {
            return new Response(302, [
                'Location' => '/'
            ]);
        }

    }
}