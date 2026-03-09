<?php

class GameManager extends AbstractManager
{
    public function findAll(): array
    {
        $query = $this->db->prepare('SELECT * FROM games');
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $games = [];

        foreach ($results as $result) {
            $game = new Game($result['name'], $result['date'], $result['team_1'], $result['team_2'], $result['winner']);
            $game->setId($result['id']);
            $games[] = $game;
        }
        return $games;
    }

    public function findOne(int $id): ?Game
    {
        $query = $this->db->prepare('SELECT * FROM games WHERE id = :id');
        $query->execute(['id' => $id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $game = new Game($result['name'], $result['date'], $result['team_1'], $result['team_2'], $result['winner']);
            $game->setId($result['id']);
            return $game;
        }
        return null;
    }
}

?>