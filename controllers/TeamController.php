<?php

class TeamController extends AbstractController
{
    public function index(): void
    {
        $manager = new TeamManager();
        $mediaManager = new MediaManager();
        
        $teams = $manager->findAll();
        $fullTeams = [];

        foreach ($teams as $team) {
            $logo = $mediaManager->findOne($team->getLogo());
            $fullTeams[] = [
                'details' => $team,
                'logoUrl' => $logo ? $logo->getUrl() : ''
            ];
        }

        $this->render('teams', ['teams' => $fullTeams]);
    }
}

?>