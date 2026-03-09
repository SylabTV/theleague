<?php

class MediaManager extends AbstractManager
{
    public function create(Media $media) : Media
    {
        $sql = "INSERT INTO media (url, alt) VALUES (:url, :alt)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "url" => $media->getUrl(),
            "alt" => $media->getAlt()
        ]);
        $media->setId((int)$this->db->lastInsertId());
        return $media;
    }

    public function update(Media $media) : Media
    {
        $sql = "UPDATE media SET url = :url, alt = :alt WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "url" => $media->getUrl(),
            "alt" => $media->getAlt(),
            "id" => $media->getId()
        ]);
        return $media;
    }

    public function delete(Media $media) : void
    {
        $sql = "DELETE FROM media WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["id" => $media->getId()]);
    }

    public function findOne(int $id) : ?Media
    {
        $sql = "SELECT * FROM media WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["id" => $id]);
        $data = $stmt->fetch();
        if(!$data) return null;
        return new Media($data["url"], $data["alt"], (int)$data["id"]);
    }

    public function findAll() : array
    {
        $sql = "SELECT * FROM media";
        $stmt = $this->db->query($sql);
        $medias = [];
        while($data = $stmt->fetch()) {
            $medias[] = new Media($data["url"], $data["alt"], (int)$data["id"]);
        }
        return $medias;
    }
}

?>