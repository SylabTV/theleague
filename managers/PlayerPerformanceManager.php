<?php

class PlayerPerformanceManager extends AbstractManager
{
    public function create(PlayerPerformance $perf) : PlayerPerformance
    {
        $sql = "INSERT INTO player_performance (player, game, points, assists) VALUES (:player, :game, :points, :assists)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "player" => $perf->getPlayer(),
            "game" => $perf->getGame(),
            "points" => $perf->getPoints(),
            "assists" => $perf->getAssists()
        ]);
        $perf->setId((int)$this->db->lastInsertId());
        return $perf;
    }

    public function update(PlayerPerformance $perf) : PlayerPerformance
    {
        $sql = "UPDATE player_performance SET player = :player, game = :game, points = :points, assists = :assists WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "player" => $perf->getPlayer(),
            "game" => $perf->getGame(),
            "points" => $perf->getPoints(),
            "assists" => $perf->getAssists(),
            "id" => $perf->getId()
        ]);
        return $perf;
    }

    public function delete(PlayerPerformance $perf) : void
    {
        $sql = "DELETE FROM player_performance WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["id" => $perf->getId()]);
    }

    public function findOne(int $id) : ?PlayerPerformance
    {
        $sql = "SELECT * FROM player_performance WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["id" => $id]);
        $data = $stmt->fetch();
        if(!$data) return null;
        return new PlayerPerformance((int)$data["player"], (int)$data["game"], (int)$data["points"], (int)$data["assists"], (int)$data["id"]);
    }

    public function findAll() : array
    {
        $sql = "SELECT * FROM player_performance";
        $stmt = $this->db->query($sql);
        $perfs = [];
        while($data = $stmt->fetch()) {
            $perfs[] = new PlayerPerformance((int)$data["player"], (int)$data["game"], (int)$data["points"], (int)$data["assists"], (int)$data["id"]);
        }
        return $perfs;
    }
}

?>