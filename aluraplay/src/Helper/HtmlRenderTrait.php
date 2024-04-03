<?php

namespace Alura\Mvc\Helper;

trait HtmlRenderTrait
{

    private function renderTemplate(string $templateName, array $context = []): string
    {
        $templatePath = __DIR__ . "/../../views/";
        extract($context);

        // inicializa um buffer de saida
        ob_start();
        require_once $templatePath . $templateName . ".php";
        return ob_get_clean();
    }

}