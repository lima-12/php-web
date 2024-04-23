<?php

use League\Plates\Engine;

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions([
    PDO::class => function (): PDO {
    $dbPath = __DIR__ . '/../banco.sqlite';
    return new PDO("sqlite:$dbPath");
    },
    Engine::class => function () {
        $templatePath = __DIR__ . "/../views";
        return new Engine($templatePath);
    }
]);

/** @var \Psr\Container\ContainerInterface $container */
$container = $builder->build();

return $container;