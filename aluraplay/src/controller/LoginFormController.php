<?php

namespace Alura\Mvc\Controller;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoginFormController implements RequestHandlerInterface
{

    public function __construct(private Engine $templates)
    {
        
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // echo "<pre>"; print_r($_SESSION); exit;
        if (array_key_exists('logado', $_SESSION) && $_SESSION['logado'] === true){
            return new Response(302, [
                'Location' => "/"
            ]);
        }

        # echo $this->renderTemplate('login_form');
        return new Response(200, [], $this->templates->render('login_form'));
    }
}