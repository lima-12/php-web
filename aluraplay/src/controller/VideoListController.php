<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class VideoListController  implements RequestHandlerInterface
{
    
    public function __construct(private VideoRepository $VideoRepository, private Engine $templates)
    {

    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $videoList = $this->VideoRepository->all();

        return new Response(
            200,
            [],
            $this->templates->render(
                'video_list',
                ['videoList' => $videoList]
            )
        );
    }
}