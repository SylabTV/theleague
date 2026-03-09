<?php

class PlayerPerformanceManager extends AbstractManager
{
    public function findAll(): array
    {
        $query = $this->db->prepare('SELECT * FROM player_performance');
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $perfs = [];

        foreach ($results as $result) {
            // Ajuste selon le constructeur de ton model PlayerPerformance
            $perf = new PlayerPerformance($result['player'], $result['game'], $result['points'], $result['assists']);
            $perf->setId($result['id']);
            $perfs[] = $perf;
        }
        return $perfs;
    }
}

?>