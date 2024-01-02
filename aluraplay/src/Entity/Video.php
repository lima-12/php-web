<?php

declare(strict_types=1);

namespace Alura\Mvc\Entity;

class Video
{
    // readonly -> só posso atribuir a essa variável uma vez.
    public readonly int $id;
    public readonly string $url;

    public function __construct(string $url, public readonly string $title) 
    {
        $this->setUrl($url);
    }

    private function setUrl(String $url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new \InvalidArgumentException('A url informada é inválida');
        }

        $this->url = $url;
    }

    public function setId(int $id): void
    { 
        $this->id = $id;
    }
}