<?php

declare(strict_types=1);

class BlogModel extends Model
{
    public function getAllPosts(): array
    {
        $stmt = $this->db->query("SELECT p.*, c.name AS category_name, c.slug AS category_slug FROM blog_posts p LEFT JOIN blog_categories c ON c.id = p.category_id WHERE p.status = 'published' ORDER BY p.published_at DESC");
        return $stmt->fetchAll();
    }

    public function getPostBySlug(string $slug): ?array
    {
        $stmt = $this->db->prepare('SELECT p.*, c.name AS category_name, c.slug AS category_slug FROM blog_posts p LEFT JOIN blog_categories c ON c.id = p.category_id WHERE p.slug = :slug AND p.status = :status LIMIT 1');
        $stmt->execute(['slug' => $slug, 'status' => 'published']);
        return $stmt->fetch() ?: null;
    }

    public function getRecentPosts(int $limit = 4): array
    {
        $stmt = $this->db->prepare("SELECT * FROM blog_posts WHERE status = 'published' ORDER BY published_at DESC LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
