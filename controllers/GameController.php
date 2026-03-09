<?php

class GameController extends AbstractController
{
    public function index(): void
    {
        $gameManager = new GameManager();
        $teamManager = new TeamManager();

        $games = $gameManager->findAll();
        $fullGames = [];

        foreach ($games as $game) {
            $t1 = $teamManager->findOne($game->getTeam1());
            $t2 = $teamManager->findOne($game->getTeam2());
            $winner = $game->getWinner() ? $teamManager->findOne($game->getWinner()) : null;

            $fullGames[] = [
                'details' => $game,
                'team1' => $t1 ? $t1->getName() : '?',
                'team2' => $t2 ? $t2->getName() : '?',
                'winner' => $winner ? $winner->getName() : 'Nul'
            ];
        }

        $this->render('matchs', ['games' => $fullGames]);
    }
}

?>