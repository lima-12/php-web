<?php

namespace Alura\Mvc\Controller;

class LoginFormController implements Controller
{
    public function processarRequisicao(): void
    {
        if (array_key_exists('logado', $_SESSION) && $_SESSION['logado'] === true){
            header('Location: /');
            return;
        }

        require_once __DIR__ . '/../../views/login_form.php';
    }
}