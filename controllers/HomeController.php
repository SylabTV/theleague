<?php

require_once 'AbstractController.php';

class HomeController extends AbstractController
{
    public function index()
    {
        $teamManager = new TeamManager();
        $playerManager = new PlayerManager();
        $mediaManager = new MediaManager();

        $team = $teamManager->findOne(1);
        
        $logo = null;
        $players = [];

        if ($team) {
            $logo = $mediaManager->findOne($team->getLogo());
            $players = $playerManager->findAll();
        }

        $this->render('home', [
            'team' => $team,
            'logo' => $logo,
            'players' => $players
        ]);
    }
}