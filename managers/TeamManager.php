<?php

class TeamManager extends AbstractManager
{
    public function findAll(): array
    {
        $query = $this->db->prepare('SELECT * FROM teams');
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $teams = [];

        foreach ($results as $result) {
            $team = new Team($result['name'], $result['description'], $result['logo']);
            $team->setId($result['id']);
            $teams[] = $team;
        }
        return $teams;
    }

    public function findOne(int $id): ?Team
    {
        $query = $this->db->prepare('SELECT * FROM teams WHERE id = :id');
        $query->execute(['id' => $id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $team = new Team($result['name'], $result['description'], $result['logo']);
            $team->setId($result['id']);
            return $team;
        }
        return null;
    }
}

?>