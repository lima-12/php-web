<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\HtmlRenderTrait;
use Alura\Mvc\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class VideoListController  implements RequestHandlerInterface
{
    use HtmlRenderTrait;
    public function __construct(private VideoRepository $VideoRepository)
    {

    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $videoList = $this->VideoRepository->all();

        return new Response(
            200,
            [],
            $this->renderTemplate(
                'video_list',
                ['videoList' => $videoList]
            )
        );
    }
}