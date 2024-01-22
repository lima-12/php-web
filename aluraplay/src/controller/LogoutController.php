<?php

namespace Alura\Mvc\Controller;

class LogoutController implements Controller
{
    public function processarRequisicao(): void
    {
        session_destroy();
        header('Location: /login');
    }
}