<?php

declare(strict_types=1);

class MediaModel extends Model
{
    public function getAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM media_library ORDER BY uploaded_at DESC');
        return $stmt->fetchAll();
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM media_library WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare('INSERT INTO media_library (file_name, file_path, file_type, file_size, uploaded_by) VALUES (:file_name, :file_path, :file_type, :file_size, :uploaded_by)');
        return $stmt->execute([
            'file_name' => $data['file_name'],
            'file_path' => $data['file_path'],
            'file_type' => $data['file_type'] ?? null,
            'file_size' => $data['file_size'] ?? 0,
            'uploaded_by' => $data['uploaded_by'] ?? null,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM media_library WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
