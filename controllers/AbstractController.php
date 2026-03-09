<?php

abstract class AbstractController
{
    protected function render(string $template, array $data = []): void
    {
        extract($data);
        $templatePath = "templates/" . $template . ".phtml";
        require_once "templates/layout.phtml";
    }
}

?>