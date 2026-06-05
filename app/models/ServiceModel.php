<?php

declare(strict_types=1);

class ServiceModel extends Model
{
    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM services WHERE status = 'published' ORDER BY sort_order ASC, id ASC");
        return $stmt->fetchAll();
    }

    public function getBySlug(string $slug): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM services WHERE slug = :slug AND status = :status LIMIT 1');
        $stmt->execute(['slug' => $slug, 'status' => 'published']);
        return $stmt->fetch() ?: null;
    }
}
