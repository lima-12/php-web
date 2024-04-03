<?php

namespace Alura\Mvc\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface Controller
{
    public function processarRequisicao(ServerRequestInterface $request): ResponseInterface;
}