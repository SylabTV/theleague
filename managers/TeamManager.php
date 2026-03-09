<?php

class TeamManager extends AbstractManager
{
    public function create(Team $team) : Team
    {
        $sql = "INSERT INTO teams (name, description, logo) VALUES (:name, :description, :logo)";
        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            "name" => $team->getName(),
            "description" => $team->getDescription(),
            "logo" => $team->getLogo()
        ]);

        $team->setId((int)$this->db->lastInsertId());
        return $team;
    }

    public function findOne(int $id) : ?Team
    {
        $sql = "SELECT * FROM teams WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["id" => $id]);

        $data = $stmt->fetch();

        if(!$data) { return null; }

        return new Team(
            $data["name"],
            $data["description"],
            (int)$data["logo"],
            (int)$data["id"]
        );
    }

    public function findAll() : array
    {
        $sql = "SELECT * FROM teams";
        $stmt = $this->db->query($sql);

        $teams = [];
        while($data = $stmt->fetch())
        {
            $teams[] = new Team(
                $data["name"],
                $data["description"],
                (int)$data["logo"],
                (int)$data["id"]
            );
        }
        return $teams;
    }

    public function delete(Team $team) : void
    {
        $sql = "DELETE FROM teams WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["id" => $team->getId()]);
    }
}

?>