<?php

declare(strict_types=1);

class ProjectModel extends Model
{
    public function getFeatured(int $limit = 6): array
    {
        $stmt = $this->db->prepare("SELECT * FROM projects WHERE status = 'published' ORDER BY sort_order ASC, id ASC LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM projects WHERE status = 'published' ORDER BY sort_order ASC, id ASC");
        return $stmt->fetchAll();
    }

    public function getBySlug(string $slug): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM projects WHERE slug = :slug AND status = :status LIMIT 1');
        $stmt->execute(['slug' => $slug, 'status' => 'published']);
        return $stmt->fetch() ?: null;
    }

    public function getGallery(int $projectId): array
    {
        $stmt = $this->db->prepare('SELECT * FROM project_gallery WHERE project_id = :project_id ORDER BY sort_order ASC, id ASC');
        $stmt->execute(['project_id' => $projectId]);
        return $stmt->fetchAll();
    }
}
