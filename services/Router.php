<?php

class Router
{
    public function handleRequest(array $get): void
    {
        $route = $get['route'] ?? 'home';

        if ($route === 'home') {
            $controller = new HomeController();
            $controller->index();
        } 
        elseif ($route === 'teams') {
            $controller = new TeamController();
            $controller->index();
        } 
        elseif ($route === 'players') {
            $controller = new PlayerController();
            $controller->index();
        } 
        elseif ($route === 'matchs') {
            $controller = new GameController();
            $controller->index();
        } 
        else {
            $controller = new HomeController();
            $controller->index();
        }
    }
}

?>