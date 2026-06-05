<?php

declare(strict_types=1);

class GalleryModel extends Model
{
    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM project_gallery ORDER BY sort_order ASC, id ASC");
        return $stmt->fetchAll();
    }

    public function getByProjectId(int $projectId): array
    {
        $stmt = $this->db->prepare('SELECT * FROM project_gallery WHERE project_id = :project_id ORDER BY sort_order ASC, id ASC');
        $stmt->execute(['project_id' => $projectId]);
        return $stmt->fetchAll();
    }
}
