<?php

declare(strict_types=1);

class PageModel extends Model
{
    public function getBySlug(string $slug): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM pages WHERE slug = :slug AND status = :status LIMIT 1');
        $stmt->execute(['slug' => $slug, 'status' => 'published']);
        $page = $stmt->fetch();
        return $page ?: null;
    }

    public function getBySlugs(array $slugs): array
    {
        if (empty($slugs)) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, count($slugs), '?'));
        $stmt = $this->db->prepare("SELECT * FROM pages WHERE slug IN ($placeholders) AND status = 'published'");
        $stmt->execute($slugs);
        return $stmt->fetchAll();
    }
}
