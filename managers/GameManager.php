<?php

class GameManager extends AbstractManager
{
    public function create(Game $game) : Game
    {
        $sql = "INSERT INTO games (name, date, team_1, team_2, winner) VALUES (:name, :date, :team_1, :team_2, :winner)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "name" => $game->getName(),
            "date" => $game->getDate(),
            "team_1" => $game->getTeam1(),
            "team_2" => $game->getTeam2(),
            "winner" => $game->getWinner()
        ]);
        $game->setId((int)$this->db->lastInsertId());
        return $game;
    }

    public function update(Game $game) : Game
    {
        $sql = "UPDATE games SET name = :name, date = :date, team_1 = :team_1, team_2 = :team_2, winner = :winner WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "name" => $game->getName(),
            "date" => $game->getDate(),
            "team_1" => $game->getTeam1(),
            "team_2" => $game->getTeam2(),
            "winner" => $game->getWinner(),
            "id" => $game->getId()
        ]);
        return $game;
    }

    public function delete(Game $game) : void
    {
        $sql = "DELETE FROM games WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["id" => $game->getId()]);
    }

    public function findOne(int $id) : ?Game
    {
        $sql = "SELECT * FROM games WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["id" => $id]);
        $data = $stmt->fetch();
        if(!$data) return null;
        return new Game($data["name"], $data["date"], (int)$data["team_1"], (int)$data["team_2"], $data["winner"] ? (int)$data["winner"] : null, (int)$data["id"]);
    }

    public function findAll() : array
    {
        $sql = "SELECT * FROM games";
        $stmt = $this->db->query($sql);
        $games = [];
        while($data = $stmt->fetch()) {
            $games[] = new Game($data["name"], $data["date"], (int)$data["team_1"], (int)$data["team_2"], $data["winner"] ? (int)$data["winner"] : null, (int)$data["id"]);
        }
        return $games;
    }
}

?>