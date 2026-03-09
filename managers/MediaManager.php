<?php

class MediaManager extends AbstractManager
{
    public function findOne(int $id): ?Media
    {
        $query = $this->db->prepare('SELECT * FROM media WHERE id = :id');
        $query->execute(['id' => $id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $media = new Media($result['url'], $result['alt']);
            $media->setId($result['id']);
            return $media;
        }
        return null;
    }
    
    public function findAll(): array
    {
        $query = $this->db->prepare('SELECT * FROM media');
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $medias = [];

        foreach ($results as $result) {
            $media = new Media($result['url'], $result['alt']);
            $media->setId($result['id']);
            $medias[] = $media;
        }
        return $medias;
    }
}

?>