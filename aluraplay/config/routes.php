<?php

return [
    'GET|/' => \Alura\Mvc\Controller\VideoListController::class,
    'GET|/novo_video' => \Alura\Mvc\Controller\VideoFormController::class,
    'POST|/novo_video' => \Alura\Mvc\Controller\AddVideoController::class,
    'GET|/editar_video' => \Alura\Mvc\Controller\VideoFormController::class,
    'POST|/editar_video' => \Alura\Mvc\Controller\EditVideoController::class,
    'GET|/remover_video' => \Alura\Mvc\Controller\DeleteVideoController::class,
    'GET|/login' => \Alura\Mvc\Controller\LoginFormController::class,
    'POST|/login' => \Alura\Mvc\Controller\LoginController::class,
    'GET|/logout' => \Alura\Mvc\Controller\LogoutController::class,
];