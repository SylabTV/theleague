<?php

class PlayerController extends AbstractController
{
    public function index(): void
    {
        $playerManager = new PlayerManager();
        $teamManager = new TeamManager();
        $mediaManager = new MediaManager();

        $players = $playerManager->findAll();
        $fullPlayers = [];

        foreach ($players as $player) {
            $team = $teamManager->findOne($player->getTeam());
            $portrait = $mediaManager->findOne($player->getPortrait());

            $fullPlayers[] = [
                'details' => $player,
                'teamName' => $team ? $team->getName() : 'Libre',
                'portraitUrl' => $portrait ? $portrait->getUrl() : ''
            ];
        }

        $this->render('players', ['players' => $fullPlayers]);
    }
}

?>