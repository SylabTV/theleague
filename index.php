<?php

require "config/autoload.php";

$router = new Router();
// On ajoute $_GET ici pour envoyer les données de l'URL au routeur
$router->handleRequest($_GET);

?>