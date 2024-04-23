<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Entity\Video;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class VideoFormController implements RequestHandlerInterface
{
    
    public function __construct(private VideoRepository $repository, private Engine $templates)
    {

    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams(); # tal como usar o $_GET[]
        $id = filter_var($queryParams['id'] ?? '', FILTER_VALIDATE_INT);

        $video = null;

        if ( $id !== false && $id !== null ){
            $video = $this->repository->find($id);
        }

        return new Response(
            200,
            [],
            $this->templates->render(
                'video_form',
                ['video' => $video]
            )
        );
    }
}