<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\FlashMessageTrait;
use Alura\Mvc\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DeleteVideoController implements RequestHandlerInterface
{
    use FlashMessageTrait;

    public function __construct(private VideoRepository $VideoRepository)
    {

    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        //$id = $_GET['id'];

        # $request->getParsedBody() #para pegar os dados do $_POST[]
        $queryParams = $request->getQueryParams(); # tal como usar o $_GET[]
        $id = filter_var($queryParams['id'], FILTER_VALIDATE_INT);
        if($id === null || $id === false) {
            $this->addErrorMessage('Id inválido!');
            return new Response(302, [
                'Location' => '/'
            ]);
        }

        $deleteVideo = $this->VideoRepository->remover($id);
        if ($deleteVideo === false){
            $this->addErrorMessage('Erro ao remover vídeo!');
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