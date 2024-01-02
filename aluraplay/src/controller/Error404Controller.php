<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class Error404Controler implements Controller
{

    public function processarRequisicao(): void
    {
        http_response_code(404);
    }
}