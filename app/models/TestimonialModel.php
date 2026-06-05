<?php

declare(strict_types=1);

class TestimonialModel extends Model
{
    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM testimonials WHERE status = 'published' ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function getLatest(int $limit = 5): array
    {
        $stmt = $this->db->prepare("SELECT * FROM testimonials WHERE status = 'published' ORDER BY id DESC LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
