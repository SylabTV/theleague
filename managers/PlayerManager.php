<?php

class PlayerManager extends AbstractManager
{
    public function create(Player $player) : Player
    {
        $sql = "INSERT INTO players (nickname, bio, portrait, team) VALUES (:nickname, :bio, :portrait, :team)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "nickname" => $player->getNickname(),
            "bio" => $player->getBio(),
            "portrait" => $player->getPortrait(),
            "team" => $player->getTeam()
        ]);
        $player->setId((int)$this->db->lastInsertId());
        return $player;
    }

    public function update(Player $player) : Player
    {
        $sql = "UPDATE players SET nickname = :nickname, bio = :bio, portrait = :portrait, team = :team WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "nickname" => $player->getNickname(),
            "bio" => $player->getBio(),
            "portrait" => $player->getPortrait(),
            "team" => $player->getTeam(),
            "id" => $player->getId()
        ]);
        return $player;
    }

    public function delete(Player $player) : void
    {
        $sql = "DELETE FROM players WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["id" => $player->getId()]);
    }

    public function findOne(int $id) : ?Player
    {
        $sql = "SELECT * FROM players WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["id" => $id]);
        $data = $stmt->fetch();
        if(!$data) return null;
        return new Player($data["nickname"], $data["bio"], (int)$data["portrait"], (int)$data["team"], (int)$data["id"]);
    }

    public function findAll() : array
    {
        $sql = "SELECT * FROM players";
        $stmt = $this->db->query($sql);
        $players = [];
        while($data = $stmt->fetch()) {
            $players[] = new Player($data["nickname"], $data["bio"], (int)$data["portrait"], (int)$data["team"], (int)$data["id"]);
        }
        return $players;
    }
}

?>