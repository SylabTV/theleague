<?php

class PlayerManager extends AbstractManager
{
    public function findAll(): array
    {
        $query = $this->db->prepare('SELECT * FROM players');
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $players = [];

        foreach ($results as $result) {
            $player = new Player($result['nickname'], $result['bio'], $result['portrait'], $result['team']);
            $player->setId($result['id']);
            $players[] = $player;
        }
        return $players;
    }

    public function findOne(int $id): ?Player
    {
        $query = $this->db->prepare('SELECT * FROM players WHERE id = :id');
        $query->execute(['id' => $id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $player = new Player($result['nickname'], $result['bio'], $result['portrait'], $result['team']);
            $player->setId($result['id']);
            return $player;
        }
        return null;
    }

    public function findByTeam(int $teamId): array
    {
        $query = $this->db->prepare('SELECT * FROM players WHERE team = :team_id');
        $query->execute(['team_id' => $teamId]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $players = [];

        foreach ($results as $result) {
            $player = new Player($result['nickname'], $result['bio'], $result['portrait'], $result['team']);
            $player->setId($result['id']);
            $players[] = $player;
        }
        return $players;
    }
}

?>