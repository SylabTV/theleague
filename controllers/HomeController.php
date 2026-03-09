<?php

class HomeController extends AbstractController
{
    public function index(): void
    {
        $teamManager = new TeamManager();
        $playerManager = new PlayerManager();
        $mediaManager = new MediaManager();

        // Récupération des données pour la home (ID 1 par défaut)
        $team = $teamManager->findOne(1);
        $logo = $team ? $mediaManager->findOne($team->getLogo()) : null;
        $players = $team ? $playerManager->findByTeam(1) : [];

        $this->render('home', [
            'team' => $team,
            'logo' => $logo,
            'players' => $players
        ]);
    }
}

?>