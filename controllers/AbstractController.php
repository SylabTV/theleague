<?php

abstract class AbstractController
{
    protected function render(string $template, array $data = [])
    {
        extract($data);

        require 'templates/layouts/_header.phtml';
        require "templates/$template.phtml";
        require 'templates/layouts/_footer.phtml';
    }
}